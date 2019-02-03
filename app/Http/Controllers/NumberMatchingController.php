<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NumberMatchingController extends Controller
{
    public function index() {
        return view('numbermatching/index');
    }
}
