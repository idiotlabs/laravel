<?php

namespace App\Http\Controllers\Sucol;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AlbumController extends Controller
{
    public function index() {

    }

    /**
     * 전체 아티스트 앨범 정보 가져오기
     */
    public function albumList() {
        $data = array();

        $size = 5;

        // 4th
        $temp = array();
        $temp['no'] = 0;
        $temp['name'] = '4th Artist';
        $temp['cover_image'] = asset('/images/sucol') . '/artist4.jpg';

        // 4th song
        $songs = array();

        $temp_song = array();
        $temp_song['artist'] = '목9';
        $temp_song['title'] = '캔디';
        $temp_song['image'] = asset('/images/sucol/team') . '/4-1.jpg';
        $temp_song['url'] = asset('/uploads/sucol') . '/candy.mp3';
        array_push($songs, $temp_song);

        $temp_song = array();
        $temp_song['artist'] = '금9';
        $temp_song['title'] = '그때';
        $temp_song['image'] = asset('/images/sucol/team') . '/4-2.jpg';
        $temp_song['url'] = asset('/uploads/sucol') . '/that.mp3';
        array_push($songs, $temp_song);

        $temp['songs'] = $songs;

        array_push($data, $temp);

        // 3th
        $temp = array();
        $temp['no'] = 1;
        $temp['name'] = '3th Artist';
        $temp['cover_image'] = asset('/images/sucol') . '/artist3.jpg';

        // 3th song
        $songs = array();

        $temp_song = array();
        $temp_song['artist'] = '목8';
        $temp_song['title'] = '타이밍';
        $temp_song['image'] = asset('/images/sucol/team') . '/3-1.jpg';
        $temp_song['url'] = asset('/uploads/sucol') . '/timing.mp3';
        array_push($songs, $temp_song);

        $temp_song = array();
        $temp_song['artist'] = '금8';
        $temp_song['title'] = '톰보이';
        $temp_song['image'] = asset('/images/sucol/team') . '/3-2.jpg';
        $temp_song['url'] = asset('/uploads/sucol') . '/tomboy.mp3';
        array_push($songs, $temp_song);

        $temp['songs'] = $songs;

        array_push($data, $temp);

        return response()->json($data);
    }

    public function albumSongList($id) {

    }
}
