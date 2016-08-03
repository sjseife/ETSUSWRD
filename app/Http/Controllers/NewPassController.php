<?php

namespace App\Http\Controllers;

use Auth;
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
    
    protected function updatePass(User $user)
    {

        $errors = array(
            'oldPassword' =>'',
            'password' => '',
            'password_confirmation' => ''
        );

        $auth = array(
            'email' => request()->get('email'),
            'password' => request()->get('oldPassword')
        );

        if (request()->get('password') != request()->get('password_confirmation')){
            $errors['password_confirmation'] = 'That password was not the same.';
            return view('/auth/newPassword')->with('user',Auth::user())->with('errors',$errors);
        }

        elseif(Auth::attempt($auth)) {
            $newPassword = bcrypt(request()->get('password'));
            User::where('email', request()->get('email'))
                ->update(array('password' => $newPassword));
            return redirect(url('/'));
        }

        else {
            $errors['oldPassword'] = 'That was not the correct password.';
            return view('/auth/newPassword')->with('user',Auth::user())->with('errors',$errors);
        }

    }
}
