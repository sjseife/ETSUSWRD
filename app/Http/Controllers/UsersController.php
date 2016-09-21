<?php

namespace App\Http\Controllers;
use App\Flag;
use App\Http\Requests\FlagRequest;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\User;
use App\Http\Requests;
use Auth;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
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

        \Session::flash('flash_message', 'User Created Successfully!');

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
        \Session::flash('flash_message', 'User Updated Successfully!');
        return redirect('/users/' . $user->id);
    }

    public function destroy(User $user)
    {
        DB::table('users_archive')->insert(
            ['id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'password' => $user->password,
                'role' => $user->role,
                'remember_token' => $user->getRememberToken(),
                'created_at' => $user->create_at,
                'updated_at' => $user->update_at,
                'archved_at' => Carbon::now()->format('Y-m-d H:i:s')]
        );
        $user->delete();
        \Session::flash('flash_message', 'User Deleted');
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

        \Session::flash('flash_message', 'Flag Created Successfully!');

        return redirect('users/'.$user->id);
    }
}
