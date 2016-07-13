<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\AuthController;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\View\Middleware\ErrorBinder;
use App\Http\Middleware\Authenticate;

class NewPassController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'password' => 'required|min:6|confirmed',
        ]);
    }
    
    protected function updatePass(Request $request, User $user)
    {/*
        dd($id);*/
        $errors = array(
            'oldPassword' =>'',
            'password' => '',
            'password_confirmation' => ''
        );

        $auth = array(
            'email' => $request['email'],
            'password' => $request['oldPassword']
        );

        if(Auth::attempt($auth)) {
            $errors['oldPassword'] = 'That was not the correct password.';
           return view('/auth/newPassword')->with('user',Auth::user)->with('errors',$errors);
        }
    
        elseif ($request['password'] != $request['password_confirmation']){
            $errors['password_confirmation'] = 'That password was not the same.';
            return view('/auth/newPassword')->with('user',Auth::user)->with('errors',$errors);
        }

        else {
            unset($request['oldPassword']);
            unset($request['password_confirmation']);
            unset($request['_method']);
            unset($request['_token']);
            $request['password'] = bcrypt($request['password']);
            User::where('id', $user->id)
                ->update($request->all());
            return view('home');
        }
        return view('home');
    }
}
