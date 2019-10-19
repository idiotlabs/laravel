<?php

namespace App\Http\Controllers\WarmMessage;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    /**
     * 유저 등록하기
     *
     * @param Request $request
     * @return JsonResponse
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

            $user_name = $request->input('user_name');
            $user_token = $request->input('user_token');

            if (is_null($user_name)) {
                throw new \Exception('not have user_name', 0);
            }

            // user_name 값이 있는 레코드 조회
            $wm_user = DB::table('wm_user')->where('user_name', $user_name)->first();

            // 기존에 등록된 아이디 값이 있는 유저
            if ($wm_user) {
                $user_id = $wm_user->id;

                // 토큰 값이 있고 기존 값이라아 다르면 업데이트
                if (!is_null($user_token) && $user_token != $wm_user->device_id) {
                    DB::table('wm_user')->where('user_name', $user_name)->update(['device_id' => $user_token]);
                }
            }
            // 기존에 등록된 아이디 값이 없는 유저
            else {
                // 혹시 토큰 값이 있는지 체크
                $wm_user = DB::table('wm_user')->where('device_id', $user_token)->first();

                if ($wm_user) {
                    DB::table('wm_user')->where('device_id', $user_token)->update(['user_name' => $user_name]);

                    $user_id = $wm_user->id;
                }
                else {
                    $user_id = DB::table('wm_user')->insertGetId(
                        ['user_name' => $user_name, 'device_id' => $user_token]
                    );
                }
            }

            $response['code'] = 1;
            $response['user_id'] = $user_id;
        } catch (\Exception $e) {
            $response['code'] = $e->getCode();
            $response['message'] = $e->getMessage();
            $response['line'] = $e->getLine();
        }

        return response()->json($response);
    }

    /**
     * 리스트 가져오기
     *
     * @param Request $request
     * @return JsonResponse
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
                ->where('wm_spread.send', 2)
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
     * @return JsonResponse
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

            $user_id = $request->input('user_id');
            $message = $request->input('message');

            $user_agent = $_SERVER['HTTP_USER_AGENT'];
            $user_ip = $_SERVER['REMOTE_ADDR'];

            $message_id = DB::table('wm_message')->insertGetId(
                ['user_id' => $user_id, 'user_agent' => $user_agent, 'user_ip' => $user_ip, 'message' => $message]
            );

            $response['code'] = $message_id;
        } catch (\Exception $e) {
            $response['code'] = $e->getCode();
            $response['message'] = $e->getMessage();
        }

        return response()->json($response);
    }
}
