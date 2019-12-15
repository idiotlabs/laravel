<?php

namespace App\Http\Controllers\Wedding;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WeddingController extends Controller
{
    public function index() {
        return view('wedding.index');
    }

    public function offline() {
        return view('wedding.offline');
    }
}
