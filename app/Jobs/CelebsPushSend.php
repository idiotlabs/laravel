<?php

namespace App\Jobs;

use App\CelebsPush;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;

class CelebsPushSend implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        config(['fcm.http.server_key' => config('fcm.celebs_push.server_key')]);
        config(['fcm.http.sender_id' => config('fcm.celebs_push.sender_id')]);

        $push_lists = CelebsPush::where('send_date', '>=', Carbon::now())->where('sent', 0)->get();

        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20);

        $dataBuilder = new PayloadDataBuilder();

        foreach ($push_lists as $push_list) {
            $send_no = $push_list->id;
            $send_number = $push_list->send_number;
            $send_message = $push_list->send_message;

            $push_title = '';
            $push_body = $send_message;
            $push_token = $push_list->device_id;

            if ($push_token) {
                $notificationBuilder = new PayloadNotificationBuilder($push_title);
                $notificationBuilder->setBody($push_body)->setSound('default');

                $option = $optionBuilder->build();
                $notification = $notificationBuilder->build();
                $data = $dataBuilder->build();

                $token = $push_token;

                for ($i = 0; $i < $send_number; $i++) {
                    $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
                    usleep(1000);
                }

                $sent = $downstreamResponse->numberSuccess();

                CelebsPush::find($send_no)->update(['sent', $sent]);
            }
        }
    }
}
