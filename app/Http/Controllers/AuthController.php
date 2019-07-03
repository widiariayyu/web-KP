<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;


class AuthController extends Controller
{
    public function login(Request $request){
       
        //dd($request->all());
        if(Auth::attempt(['username' => $request->username, 'password'=>$request->password]))
        {
            $user = User::join('role_user','role_user.user_id','=','users.id')
            ->where('username',$request->username)->first();
           
            if($user->role_id==1){
                return redirect()->route('home');
            }
            return redirect()->route('admin');
        }
        else 
        {
            return view('auth.login');
        }
    }
}
