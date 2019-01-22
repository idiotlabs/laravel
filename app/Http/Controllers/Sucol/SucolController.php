<?php

namespace App\Http\Controllers\Sucol;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SucolController extends Controller
{
    public function index(Request $request)
    {
        return view('sucol.index');
    }

    /**
     * artistalbum application admin
     */
    public function artistalbum()
    {
        return view('sucol.artistalbum', [
          'token' => null,
          'email' => '',
          'action' => 'reset_password',
        ]);
    }
}
