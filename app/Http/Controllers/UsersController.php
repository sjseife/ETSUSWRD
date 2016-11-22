<?php

namespace App\Http\Controllers;
use App\Flag;
use App\Http\Requests\FlagRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\User;
use App\Role;
use App\Http\Requests;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        $roles = Role::where('id', '>',  '2')->lists('name', 'id');

        return view('users.create', compact('roles'));
    }

    public function store(UserRequest $request)
    {

        /*$roleName = $request->get('role')*/
        //other validation is done in UserRequest, this simply checks that the email is unique
        $this->validate($request,
            ['email' => 'unique:users']);
        $user = new User($request->all());
        $user->password = bcrypt($request->get('password'));
        $user->role_id = $request->get('role_id');
        $user->save();

        flash($user->name . ' created successfully!', 'success');

        return redirect('users');
    }

    public function edit(User $user)
    {
        $roles = Role::where('id', '>',  '2')->lists('name', 'id');
        return view('users.edit', compact('user' , 'roles'));
    }

    public function update(User $user, UserRequest $request)
    {
        //other validation is done in UserRequest, this simply checks that the email is unique except for this user
        $newPassword = $request->get('password'); //get password

        /*$this->validate($request,
            ['email' => 'unique:users,email,'.$user->id]);*/
        if(empty($newPassword)){
            $user->update($request->except('password'));
            $user->role_id = $request->get('role_id');
            $user->save();
        }else{
            $user->update($request->all());
            $user->password = bcrypt($request->get('password'));
            $user->role_id = $request->get('role_id');
            $user->save();
        }
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

}
