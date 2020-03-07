<?php

namespace App\Http\Controllers\Wedding;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WeddingController extends Controller
{
    public function index() {

        $board_list = DB::table('wedding_board')->get();

        return view('wedding.index')->with('board_list', $board_list);
    }

    public function offline() {
        return view('wedding.offline');
    }

    public function write(Request $request) {
        $text = $request->input('text');
        $name = $request->input('name');

        $agent = $_SERVER['HTTP_USER_AGENT'];
        $ip = $_SERVER['REMOTE_ADDR'];

        // sql
        $result = DB::table('wedding_board')->insert(
            ['name' => $name, 'text' => $text, 'date' => Carbon::now(), 'agent' => $agent, 'ip' => $ip]
        );

        $html = view('wedding.partials.board-box')->render();
        $html = str_replace('{text}', $text, $html);
        $html = str_replace('{name}', $name, $html);
        $html = str_replace('{date}', mb_substr(Carbon::now(), 0, 10), $html);

        $data = [];
        $data['html'] = $html;
        $data['result'] = $result;

        return response()->json($data);
    }
}
