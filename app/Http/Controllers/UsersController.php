<?php

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

class UsersController extends Controller
{
    public function index()
    {
        $users = User::where('archived','=','0')->get();
        return view('users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(UserRequest $request)
    {
        //other validation is done in UserRequest, this simply checks that the email is unique
        $this->validate($request,
            ['email' => 'unique:users']);
        $user = new User($request->all());
        $user->save();

        flash($user->name . ' created successfully!', 'success');

        return redirect('users');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(User $user, UserRequest $request)
    {
        //other validation is done in UserRequest, this simply checks that the email is unique except for this user
        $this->validate($request,
            ['email' => 'unique:users,email,'.$user->id]);
        $user->update($request->all());
        flash($user->name . ' updated successfully!', 'success');
        return redirect('/users/' . $user->id);
    }

    public function destroy(User $user)
    {
        $user->archived = '1';
        $user->save();

        flash($user->name . ' deleted.', 'success');
        return redirect('/users');

    }

    /*
     * This method takes in a user, compacts it into a "common flag format" and sends it to the flag.create view
     */
    public function flag(User $user)
    {
        return view('flags.create')->with('url', 'users/flag/' . $user->id)
            ->with('name', $user->Name);
    }

    public function storeFlag(User $user, FlagRequest $request)
    {
        $flagData = ['level' => $request->level,
            'comments' => $request->comments,
            'resolved' => '0',
            'user_id' => $user->id,
            'submitted_by' => Auth::id()];
        $flag = new Flag($flagData);
        $flag->save();

        flash('Flag created successfully!','success');

        return redirect('users/'.$user->id);
    }
}
