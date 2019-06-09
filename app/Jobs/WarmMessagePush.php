<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;

class WarmMessagePush implements ShouldQueue
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
//        $optionBuilder = new OptionsBuilder();
//        $optionBuilder->setTimeToLive(60 * 20);
//
//        $notificationBuilder = new PayloadNotificationBuilder('my title');
//        $notificationBuilder->setBody('Hello world')->setSound('default');
//
//        $dataBuilder = new PayloadDataBuilder();
//        $dataBuilder->addData(['a_data' => 'my_data']);
//
//        $option = $optionBuilder->build();
//        $notification = $notificationBuilder->build();
//        $data = $dataBuilder->build();
//
//        $tokens = DB::table('wm_user')->whereNotNull('device_id')->pluck('device_id')->toArray();
//
//        $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $data);

        $push_lists =  DB::table('wm_spread')
                        ->leftJoin('wm_message', 'wm_spread.message_id', '=', 'wm_message.id')
                        ->leftJoin('wm_user', 'wm_spread.receive_user_id', '=', 'wm_user.id')
                        ->where('send', 0)
                        ->whereNotNull('device_id')
                        ->select('wm_message.message', 'wm_user.device_id')
                        ->get();

        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20);

        $dataBuilder = new PayloadDataBuilder();

        foreach($push_lists as $push_list) {
            $push_title = '당신께 도착한 말이 있습니다';
            $push_body = $push_list->message;
            $push_token = $push_list->device_id;

            $notificationBuilder = new PayloadNotificationBuilder($push_title);
            $notificationBuilder->setBody($push_body)->setSound('default');

            $option = $optionBuilder->build();
            $notification = $notificationBuilder->build();
            $data = $dataBuilder->build();

            $token = $push_token;

            $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
        }

//        $downstreamResponse->numberSuccess();
//        $downstreamResponse->numberFailure();
//        $downstreamResponse->numberModification();
//
//        //return Array - you must remove all this tokens in your database
//        $downstreamResponse->tokensToDelete();
//
//        //return Array (key : oldToken, value : new token - you must change the token in your database )
//        $downstreamResponse->tokensToModify();
//
//        //return Array - you should try to resend the message to the tokens in the array
//        $downstreamResponse->tokensToRetry();
//
//        // return Array (key:token, value:errror) - in production you should remove from your database the tokens present in this array
//        $downstreamResponse->tokensWithError();
    }
}
