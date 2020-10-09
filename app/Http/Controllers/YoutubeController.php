<?php

namespace App\Http\Controllers;

use App\Models\CrawlingYoutubeTrend;
use Illuminate\Http\Request;

class YoutubeController extends Controller
{
    public function trend($count = null)
    {
        $lastCrawlingYoutubeTrend = [];
        $response = [];

        try {
            if (is_null($count)) {
                $lastRow = CrawlingYoutubeTrend::orderByDesc('id')->limit(1)->first();

                $count = $lastRow->count;
            }

            $lastCrawlingYoutubeTrend = CrawlingYoutubeTrend::where('count', $count)->get();
        } catch (\Exception $e) {
            $response['msg'] = $e->getMessage();
        }

        $response['data'] = $lastCrawlingYoutubeTrend;

        return response()->json($response);
    }
}
