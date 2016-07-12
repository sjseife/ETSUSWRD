<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class NewPassController extends Controller
{

    protected function updatePass(Request $request, User $id)
    {/*
        dd($id);*/
        unset($request['_method']);
        unset($request['_token']);
        User::where('id', $id->id)
            ->update($request->all());
        return view('index');
    }
}
