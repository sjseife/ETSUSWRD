<?php

namespace App\Http\Controllers;
use Yajra\Datatables\Datatables;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::all();

        // load the view and pass the users
        return view('user.index')
            ->with('users', $users);
    }
    public function edit(User $id)
    {
        return view('user.edit', compact('id'));
    }

    public function update(Request $request, User $id)
    {
        unset($request['_method']);
        unset($request['_token']);
        User::where('Id', $id->id)
            ->update($request->all());
        return back();
    }

    public function view(User $id)
    {
        return view('user.view', compact('id'));
    }
    
    public function delete(User $id)
    {
        return view('user.delete', compact('id'));
    }

    public function destroy($id)
    {
        try{
            DB::delete('delete from users where id = "' . $id . '"');
            return redirect('/users');
        }
        catch (Exeption $e) {
            return $e;
        }
    }
}
