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
            $user_id = $request->user_id;
            $index = $request->index;
            $offset = $request->offset;

            $results = DB::table('wm_message')
                ->select('id', 'message', 'created_at')
                ->where('user_id', $user_id)
                ->offset($index)
                ->limit($offset)
                ->orderByDesc('id')
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
     *
     * 메세지 저장하기
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function send(Request $request)
    {
        try {
            $response = [];

            $user_id = $request->user_id;
            $message = $request->message;

            $user_agent = $_SERVER['HTTP_USER_AGENT'];
            $user_ip = $_SERVER['REMOTE_ADDR'];

            $result = DB::table('wm_message')->insertGetId(
                ['user_id' => $user_id, 'user_agent' => $user_agent, 'user_ip' => $user_ip, 'message' => $message]
            );

            $this->spread($result);

            $response['code'] = $result;
        } catch (\Exception $e) {
            $response['code'] = $e->getCode();
            $response['message'] = $e->getMessage();
        }

        return response()->json($response);
    }

    /**
     * 메세지 뿌리기
     *
     * @param $message_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function spread($message_id)
    {
        try {
            $users = DB::table('wm_user')->inRandomOrder()->limit(5)->get();

            foreach ($users as $user) {
                DB::table('wm_spread')->insert(
                    ['message_id' => $message_id, 'receive_user_id' => $user->id]
                );
            }
        } catch (\Exception $e) {
            $response['code'] = $e->getCode();
            $response['message'] = $e->getMessage();
        }

        return response()->json($response);
    }
}
