<?php

namespace App\Http\Controllers\Sucol;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SucolController extends Controller
{
    public function index(Request $request) {
        return view('sucol.index');
    }

    /**
     * artistalbum application admin
     */
    public function artistalbum() {
        return view('sucol.artistalbum', [
          'token' => null,
          'email' => '',
          'action' => 'reset_password',
        ]);
    }
}
