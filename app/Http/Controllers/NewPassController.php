<?php

namespace App\Http\Controllers;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\View\Middleware\ErrorBinder;

class NewPassController extends Controller
{


    protected function updatePass(Request $request, User $user)
    {/*
        dd($id);*/

        $errors = array(
            'oldPassword' =>'',
            'password' => '',
            'password_confirmation' => ''
        );

        if(bcrypt($request['oldPassword']) != $user['password']) {
            $errors['oldPassword'] = 'That password was not correct.';
           return view('/auth/newPassword')->with('user',$user)->with('errors',$errors);
        }
    
        elseif ($request['password'] != $request['password_confirmation']){
            $errors['password_confirmation'] = 'That password was not correct.';
            return view('/auth/newPassword')->with('user', $user)->with('errors',$errors);
        }

        else {
            unset($request['oldPassword']);
            unset($request['password_confirmation']);
            unset($request['_method']);
            unset($request['_token']);
            User::where('id', $user->id)
                ->update($request->all());
            return view('home');
        }
        return view('home');
    }
}
