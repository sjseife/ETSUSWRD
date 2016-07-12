<?php

namespace App\Http\Controllers;
use Yajra\Datatables\Datatables;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        return view('user.index2');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        return Datatables::of(User::query())->make(true);
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
}
