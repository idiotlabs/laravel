<?php

namespace App\Http\Controllers\WM;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    /**
     * 유저 등록하기
     */
    public function user(Request $request) {
        $response = array();

        try {
            $user_token = $request->user_token;

            if ($user_token == '') {
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
        $response = array();

        try {
            $user_id = $request->user_id;
            $index = $request->index;
            $offset = $request->offset;

            $sql = "select id, message, created_at from wm_message where user_id = ? order by id desc limit ?, ?";
            $results = DB::select($sql, [$user_id, $index, $offset]);

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
            $response = array();

            $user_id = $request->user_id;
            $message = $request->message;

            $user_agent = $_SERVER['HTTP_USER_AGENT'];
            $user_ip = $_SERVER['REMOTE_ADDR'];

            $sql = "insert into wm_message (user_id, user_agent, user_ip, message) values (?, ?, ?, ?)";
            $result = DB::insert($sql, [$user_id, $user_agent, $user_ip, $message]);

            $response['code'] = $result;
        } catch (\Exception $e) {
            $response['code'] = $e->getCode();
            $response['message'] = $e->getMessage();
        }

        return response()->json($response);
    }
}
