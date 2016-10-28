<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;
use App\Flag;
use App\Http\Requests\FlagRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\User;
use App\Http\Requests;
use Auth;
use Illuminate\Support\Facades\DB;

class ArchiveUsersController extends Controller
{
    public function index()
    {
        $users = User::where('archived','=','1')->get();
        return view('archive_users.index', compact('users'));
    }

    public function show(User $user)
    {
        //$user = User::findOrFail($id);
        //Incrementing view count when viewed
        //app('App\Http\Controllers\ViewsController')->userView($user);

        return view('archive_users.show', compact('user'));
    }


    public function restore(User $user, Request $request)
    {
        $user->archived = '0'; //set archived back to false
        $user->save();

        if($request->ajax())
        {
            return response()->json(); //it just needs any JSON response to indicate a success.
        }
        else
        {
            \Session::flash('flash_message', 'User Added to Work List');
            return Redirect::back();
        }
    }

    public function removeReport(User $user, Request $request)
    {
        Auth::user()->users()->detach($user);
        if($request->ajax())
        {
            return response()->json(); //it just needs any JSON response to indicate a success.
        }
        else
        {
            \Session::flash('flash_message', $user->name.' removed from the Report.');
            return Redirect('/worklist/generateReport');
        }
    }

    public function showRestore(User $user, Request $request)
    {
        $user->archived = '0'; //set archived back to false
        $user->save();

        flash($user->name . ' was restored to users!', 'success');
        return redirect('/archive_users');
    }

}
