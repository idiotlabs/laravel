<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class WarmMessageSpread implements ShouldQueue
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
        // 보낼 메세지 리스트
        $messages = DB::table('wm_message')->where('message_state', 1)->get();

        foreach ($messages as $message) {
            $message_id = $message->id;
            $user_id = $message->user_id;

            // 나를 제외한 5명을 랜덤으로 가져온다
            $users = DB::table('wm_user')
                ->where('id', '<>', $user_id)
                ->inRandomOrder()->limit(5)->get();

            foreach ($users as $user) {
                DB::table('wm_spread')->insert(
                    ['message_id' => $message_id, 'receive_user_id' => $user->id, 'send' => 0]
                );
            }

            DB::table('wm_message')->where('id', $message_id)->update(
                ['message_state' => 2, 'updated_at' => now()]
            );
        }

        // Push
        WarmMessagePush::dispatch();
    }
}
