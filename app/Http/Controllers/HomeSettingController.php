<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeSettingController extends Controller
{
    public function index(Request $request)
    {
        $user_id = base64_decode($request->session()->get('user_id'));
        $role_id = base64_decode($request->session()->get('role_id'));

        return view('admin.dashboard', [
            'title'     => 'Dashboard',
        ]);
    }
}
