<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RollingPaperController extends Controller
{
    private $color_list = array();

    function __construct()
    {
        $this->color_list = array('yellow', 'blue', 'pink', 'green');
    }

    public function write() {
        return view('rollingpaper.write');
    }

    public function paper($name) {
        $sql = "select * from rolling_paper where receiver = ? and note != '' order by id desc";
        $note_list = DB::select($sql, [$name]);

        foreach($note_list as &$note) {
            $note->color = $this->color_list[array_rand($this->color_list)];
        }

        return view('rollingpaper.paper')->with('note_list', $note_list);
    }

    function post(Request $request) {
        $receiver = $request->input('receiver', '');
        $text = $request->input('text', '');

        // sql
        $result = DB::table('rolling_paper')->insert(
            ['receiver' => $receiver, 'note' => $text, 'date' => Carbon::now()]
        );

        $data = [];
        $data['result'] = $result;

        return response()->json($data);
    }
}
