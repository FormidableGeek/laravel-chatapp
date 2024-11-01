<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;

class AuthenticationController extends Controller
{
    public function index()
    {
        return view('auth.signup');
    }

    public function signin()
    {
        return view('auth.signin');
    }

    public function register(RegisterRequest $request)
    {
        try{

            $register=User::create([
                'name'=>$request->username,
                'email'=>$request->email,
                'password'=>$request->password
            ]);

            if($register){
                if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
                    return redirect('/chats');

                }else{
                    flash()->error('An error occured, please try again later!');
                    return redirect('/');

                }
            }

        }catch(\Throwable $e){
            flash()->error('An error occured, please try again later!');
            return redirect('/');


        }
        
        
    }

    public function login(LoginRequest $request)
    {
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect('/chats');

        }else{
            flash()->warning('Credentials entered does not match our records!');
            return redirect('/login');
            
        }
        
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
