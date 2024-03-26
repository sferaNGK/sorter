<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function AuthAdmin(Request $request){
        $user = User::query()->where('login',$request->login)->where('password',md5($request->password))->first();
        if($user){
            Auth::login($user);
            return redirect()->route('show_admin_page');
        }else{
            return redirect()->back();
        }
    }
    public function AdminLog(){
        Auth::logout();
        return redirect()->route('welcome');
    }
}
