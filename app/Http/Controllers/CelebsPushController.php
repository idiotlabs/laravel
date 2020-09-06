<?php

namespace App\Http\Controllers;

use App\CelebsPush;
use Illuminate\Http\Request;

class CelebsPushController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addCelebsPush(Request $request)
    {
        $response = [];

        try {
            $header = $request->header('Authorization');
            $auth = explode(" ", $header);

            if (!($auth[0] == "Bearer" && $auth[1] == config('services.celebs_push.key'))) {
                throw new \Exception('not auth', 0);
            }

            $send_date = $request->input('send_date', '');
            $send_number = $request->input('send_number', '');
            $send_message = $request->input('send_message', '');
            $device_id = $request->input('device_id', '');

            $celebsPush = CelebsPush::create([
                'send_date' => $send_date,
                'send_number' => $send_number,
                'send_message' => $send_message,
                'device_id' => $device_id,
            ]);

            $response['data'] = $celebsPush;
        } catch (\Exception $e) {
            $response['code'] = $e->getCode();
            $response['message'] = $e->getMessage();
        }

        return response()->json($response);
    }

    public function send()
    {

    }
}
