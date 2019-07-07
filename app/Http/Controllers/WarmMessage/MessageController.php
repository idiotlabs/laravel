<?php

namespace App\Http\Controllers\WarmMessage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    /**
     * 유저 등록하기
     */
    public function user(Request $request)
    {
        $response = [];

        try {
            $header = $request->header('Authorization');
            $auth = explode(" ", $header);

            if (!($auth[0] == "Bearer" && $auth[1] == "a-b-c")) {
                throw new \Exception('not auth', 0);
            }

            $user_token = $request->user_token;

            if ($user_token === '') {
                throw new \Exception('not have user_token', 0);
            }

            // 기존에 등록된 기기 값이 있는 유저
            if (DB::table('wm_user')->where('device_id', $user_token)->count() > 0) {
                $user_id = DB::table('wm_user')->where('device_id', $user_token)->first()->id;
            }
            // 기존에 등록된 기기 값이 없는 유저
            else {
                $user_id = DB::table('wm_user')->insertGetId(
                    ['device_id' => $user_token]
                );
            }

            $response['code'] = 1;
            $response['user_id'] = $user_id;
        } catch (\Exception $e) {
            $response['code'] = $e->getCode();
            $response['message'] = $e->getMessage();
        }

        return response()->json($response);
    }

    /**
     * 리스트 가져오기
     */
    public function list(Request $request)
    {
        $response = [];

        try {
            $header = $request->header('Authorization');
            $auth = explode(" ", $header);

            if (!($auth[0] == "Bearer" && $auth[1] == "a-b-c")) {
                throw new \Exception('not auth', 0);
            }

            $user_id = $request->user_id;
            $index = $request->index;
            $offset = $request->offset;

            // 발송 받은 메세지 가져오기

            // select b.id, b.message, b.created_at from wm_spread a left join wm_message b on a.message_id = b.id
            // where a.receive_user_id = 2 and a.send = 1
            $results = DB::table('wm_spread')
                ->select('wm_message.id', 'wm_message.message', 'wm_message.created_at')
                ->leftJoin('wm_message', 'wm_spread.message_id', '=', 'wm_message.id')
                ->where('wm_spread.receive_user_id', $user_id)
                ->where('wm_spread.send', 1)
                ->offset($index)
                ->limit($offset)
                ->orderByDesc('wm_spread.id')
                ->get();

            $response['data'] = $results;
            $response['count'] = count($results);
        } catch (\Exception $e) {
            $response['code'] = $e->getCode();
            $response['message'] = $e->getMessage();
        }

        return response()->json($response);
    }

    /**
     * 메세지 저장하기
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function send(Request $request)
    {
        $response = [];

        try {
            $header = $request->header('Authorization');
            $auth = explode(" ", $header);

            if (!($auth[0] == "Bearer" && $auth[1] == "a-b-c")) {
                throw new \Exception('not auth', 0);
            }

            $user_id = $request->user_id;
            $message = $request->message;

            $user_agent = $_SERVER['HTTP_USER_AGENT'];
            $user_ip = $_SERVER['REMOTE_ADDR'];

            $message_id = DB::table('wm_message')->insertGetId(
                ['user_id' => $user_id, 'user_agent' => $user_agent, 'user_ip' => $user_ip, 'message' => $message]
            );

            $this->spread($user_id, $message_id);

            $response['code'] = $message_id;
        } catch (\Exception $e) {
            $response['code'] = $e->getCode();
            $response['message'] = $e->getMessage();
        }

        return response()->json($response);
    }

    /**
     * 메세지 뿌리기
     *
     * @param $user_id
     * @param $message_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function spread($user_id, $message_id)
    {
        $response = [];

        try {
            // 나를 제외한 5명을 랜덤으로 가져온다
            $users = DB::table('wm_user')
                ->where('id', '<>', $user_id)
                ->inRandomOrder()->limit(5)->get();

            foreach ($users as $user) {
                DB::table('wm_spread')->insert(
                    ['message_id' => $message_id, 'receive_user_id' => $user->id, 'send' => 0]
                );
            }
        } catch (\Exception $e) {
            $response['code'] = $e->getCode();
            $response['message'] = $e->getMessage();
        }

        return response()->json($response);
    }
}
