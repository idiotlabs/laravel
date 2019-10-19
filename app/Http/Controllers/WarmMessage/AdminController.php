<?php

namespace App\Http\Controllers\WarmMessage;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function admin()
    {
        return view('warmmessage.dashboard');
    }

    public function privacy()
    {
        return view('warmmessage.privacy');
    }

    /**
     * @return Factory|View
     */
    public function messages()
    {
        $messages = DB::table('wm_message')->orderByDesc('id')->get();

        return view('warmmessage.messages', ['messages' => $messages]);
    }
}
