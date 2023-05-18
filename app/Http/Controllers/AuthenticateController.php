<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class AuthenticateController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function auth(Request $request)
    {
        $validation = $request->validate([
            'username'  => 'required',
            'password'  => 'required',
        ],
        [
            'username.required' => 'This field is required.',
            'password.required' => 'This field is required.',
        ]);

        $credentials = $request->only('username', 'password');
        $user = new User;
        $getUser = $user->authenticateUser($request->username);

        if(isset($getUser)){
            $user_id = base64_encode($getUser->id);
            $role_id = base64_encode($getUser->role_id);
            $username = $getUser->username;
        }else{
            Alert::question('Oops..', 'Your credential do not match in our records. Please try again.');
            return back();
        }

        if(Auth::attempt($credentials) && $getUser->is_active == 1){
            $request->session()->regenerate();
            $request->session()->put('user_id', $user_id);
            $request->session()->put('role_id', $role_id);
            $request->session()->put('username', $username);
            Alert::toast('Welcome, you login successfully as ' . $username . '.', 'success');
            return redirect()->intended('admin/dashboard')->withSuccess('Signed In');
        }else{
            Alert::question('Oops..', 'Your credential are incorrect. Please try again.');
            return back()->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->flush();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
