<?php

namespace App\Http\Controllers\Wedding;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PWAController extends Controller
{
    public function manifest_json() {
        $image_sizes = ['72', '96', '128', '144', '152', '192', '384', '512'];

        $json = [];
        $json['name'] = 'name';
        $json['short_name'] = 'short_name';
        for ($i = 0; $i < sizeof($image_sizes); $i++) {
            $data = [];
            $data['src'] = '/images/wedding/icons/icon' . $image_sizes[$i] . '.png';
            $data['sizes'] = $image_sizes[$i] . 'x' . $image_sizes[$i];
            $data['type'] = 'image/png';

            $json['icons'][$i] = $data;
        }
        $json['start_url'] = '/';
        $json['display'] = 'standalone';
        $json['background_color'] = '#ffffff';
        $json['theme_color'] = '#ededed';

        return response()->json($json);
    }
}
