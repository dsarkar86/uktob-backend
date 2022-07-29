<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function index(){
        return view('register');
    }

    public function register1(){
        echo 'Register here ...';
    }

    public function forgot_password(){
        return view('forget-password');
    }
    
    public function forgot_password_submit(Request $request){
        

        //$updatePassword = DB::table('password_resets')->where(['email' => $request->email, 'token' => $request->token])->first();
        $res = DB::table('tbl_user')->where('email', $request->input('email'))->first();

        if(!$res){
            return back()->withInput()->with('error', 'Email id not present');
        }else{

            $user = DB::table('tbl_user')->where('email', $request->input('email'))->update(['password' => Hash::make('111111')]);

            //DB::table('tbl_user')->where(['email'=> $request->email])->delete();

            return redirect('/')->with('message', 'Your password has been changed!');
        }
    }

    public function forgot_password1(){
        echo 'Forgot password here ...';
    }

}
