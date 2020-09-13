<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
//use LaravelFCM\Facades\FCM;
//use LaravelFCM\Message\OptionsBuilder;
//use LaravelFCM\Message\PayloadDataBuilder;
//use LaravelFCM\Message\PayloadNotificationBuilder;

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
        /*
        // wm_spread table에서 발송이 안된 (send가 0인) 레코드를 가져온다.
        $push_lists =  DB::table('wm_spread')
                        ->leftJoin('wm_message', 'wm_spread.message_id', '=', 'wm_message.id')
                        ->leftJoin('wm_user', 'wm_spread.receive_user_id', '=', 'wm_user.id')
                        ->where('send', '<', 0)
                        ->select('wm_spread.id', 'wm_message.message', 'wm_user.device_id')
                        ->get();

        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20);

        $dataBuilder = new PayloadDataBuilder();

        foreach($push_lists as $push_list) {
            $wm_spread_id = $push_list->id;

            $push_title = '도착한 따뜻함이 있습니다.';
            $push_body = $push_list->message;
            $push_token = $push_list->device_id;

            $send = 0;

            if ($push_token) {
                $notificationBuilder = new PayloadNotificationBuilder($push_title);
                $notificationBuilder->setBody($push_body)->setSound('default');

                $option = $optionBuilder->build();
                $notification = $notificationBuilder->build();
                $data = $dataBuilder->build();

                $token = $push_token;

                $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

                $send = $downstreamResponse->numberSuccess();
            }

            // wm_spread table에 발송 이력 업데이트
            DB::table('wm_spread')
                ->where('id', $wm_spread_id)
                ->update(['send' => $send]);
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
        */
    }
}
