<?php

namespace App\Http\Controllers\Sucol;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlbumController extends Controller
{
    public function index()
    {
    }

    /**
     * (api) 전체 아티스트 앨범 정보 가져오기
     */
    public function albumList()
    {
        $data = [];

        $albums = DB::select('select * from sucol_albums order by id desc');

        foreach ($albums as $album) {
            $temp = [];

            // album
            $temp['no'] = $album->id;
            $temp['name'] = $album->title;
            $temp['cover_image'] = $album->image;

            // songs
            $songs = [];

            $song_list = DB::select('select * from sucol_album_songs where album_id = ?', [$album->id]);

            foreach ($song_list as $song) {
                $temp_song = [];
                $temp_song['id'] = $song->id;
                $temp_song['artist'] = $song->artist;
                $temp_song['title'] = $song->name;
                $temp_song['image'] = $song->image;
                $temp_song['url'] = $song->url;
                array_push($songs, $temp_song);
            }

            $temp['songs'] = $songs;

            // push in data
            array_push($data, $temp);
        }

        return response()->json($data);
    }

    public function albumSongList($id)
    {
    }

    /**
     * (api) 앨범 최초 등록
     */
    public function addAlbum()
    {
        $sql = "insert into sucol_albums (create_at) values (now())";
        $results = DB::insert($sql);

        if ($results) {
            return $this->albumList();
        }
    }

    /**
     * (api) 앨범 수정
     */
    public function updateAlbum(Request $request)
    {
        $id = $request->input('id');
        $title = $request->input('title');
        $image = $request->input('img');
        $songs = $request->input('songs');
        $deletesongs = $request->input('deletesongs');

        // album update
        try {
            $sql = "update sucol_albums set title = ?, image = ? where id = ?";
            $result = DB::update($sql, [$title, $image, $id]);

            foreach ($songs as $song) {
                if ($song['id'] == 'new') {
                    $sql = "insert into sucol_album_songs (album_id, artist, name, image, url, create_at) values (?, ?, ?, ?, ?, now())";
                    $result = DB::insert($sql, [$id, $song['artist'], $song['title'], $song['image'], $song['url']]);
                } else {
                    $sql = "update sucol_album_songs set artist = ?, name = ?, image = ?, url = ? where id = ?";
                    $result = DB::update($sql, [$song['artist'], $song['title'], $song['image'], $song['url'], $song['id']]);
                }
            }

            foreach ($deletesongs as $song_id) {
                $sql = "delete from sucol_album_songs where id = ?";
                $result = DB::delete($sql, [$song_id]);
            }

            return $this->albumList();
        } catch (\Exception $e) {
            return response()->json($e);
        }
    }

    /**
     * (api) 앨범 삭제
     */
    public function deleteAlbum(Request $request)
    {
        $id = $request->input('id');

        $sql = "delete from sucol_albums where id = ?";
        $result = DB::delete($sql, [$id]);

        if ($result) {
            return $this->albumList();
        }
    }
}
