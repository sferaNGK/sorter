<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request){
        $user = User::query()->where('login',$request->login)->where('password',md5($request->password))->first();
        if($user){
            Auth::login($user);
            return redirect()->route('show_admin_page');
        }else{
            return redirect()->back();
        }
    }
    public function register(Request $request){
        $valid = Validator::make($request->all(),[
            'login'=>['required'],
            'password'=>['required'],
        ],[
            'login.required'=>'Поле обязательно для заполнения',
            'password.required'=>'Поле обязательно для заполнения',
        ]);
        if($valid->fails()){
            return response()->json(400,$valid->errors());
        }
        $user = new User();
        $user->login = $request->login;
        $user->password = md5($request->password);
        $user->save();
        return redirect()->route('show_adminreg_page');
    }
    public function AdminLog(){
        Auth::logout();
        return redirect()->route('welcome');
    }
}
