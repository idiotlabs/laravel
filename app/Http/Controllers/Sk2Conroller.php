<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class Sk2Conroller extends Controller
{
    public function latest(Request $request)
    {
        $TIME_STANDARD = $request->get('minutes', 60);

        $base_url = "https://forum.netmarble.com/api/game/sknightsmmo/official/forum/sk2/article/list?rows=15&start=0&menuSeq=";

        $menu_seq = [
            'notice' => 8,
            'update' => 25,
            'developer' => 9,
        ];

        $now = Carbon::now();

        $response_list = [];

        // guzzle
        foreach ($menu_seq as $seq => $seq_num) {
            $client = new Client();
            $response = $client->request('GET', $base_url . $seq_num);

            $body = $response->getBody();
            $contents = $body->getContents();
            $contents = json_decode($contents);

            $articleList = $contents->articleList;

            foreach ($articleList as $list) {
                $title = $list->title;
                $regDate = $list->regDate;
                $regDate = Carbon::createFromTimestamp($regDate / 1000);

                if ($now->diffInMinutes($regDate) < $TIME_STANDARD) {
                    $temp = [];
                    $temp['title'] = $title;
                    $temp['date'] = $regDate->toDateTimeString();

                    $response_list[$seq][] = $temp;

                    continue;
                }

                break;
            }
        }

        return response()->json($response_list);
    }
}
