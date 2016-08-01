<?php

namespace App\Http\Controllers;

use App\Flag;
use App\Resource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;

class FlagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $flags = Flag::all();
        $resources = Resource::all();
        $users = User::all();

        // load the view and pass the flags, users, resources
        return view('flag.index', compact('flags', 'resources', 'users'));
    }

    public function create()
    {
        $resource = Resource::all();
        $user = User::all();
        return view('flag.create', compact('resource', 'user'));
    }

    public function createFlag()
    {
        $flag = new Flag(request()->all());
        $flag->save();
        return redirect('/resource');
    }

    public function view(Flag $id)
    {
        $resource = Resource::all();
        $user = User::all();
        return view('flag.view', compact('id', 'resource', 'user'));
    }

    public function resourceView(Resource $id)
    {
        $flag = Flag::all();
        $user = User::all();
        return view('flag.viewresourceflags', compact('id', 'flag', 'user'));
    }

    public function edit(Flag $id)
    {
        $resource = Resource::all();
        $user = User::all();
        return view('flag.edit', compact('id', 'resource', 'user'));
    }

    public function update(Request $request, Flag $id)
    {
        unset($request['_method']);
        unset($request['_token']);
        $id->setUpdatedAt(null);
        $id->setCreatedAt(null);
        Flag::where('Id', $id->Id)
            ->update($request->all());
        return redirect('/flag');
    }

    public function delete(Flag $id)
    {
        $resource = Resource::all();
        $user = User::all();
        return view('flag.delete', compact('id', 'resource', 'user'));
    }

    public function destroy($id)
    {
        try{
            DB::delete('delete from flag where id = "' . $id . '"');
            return redirect('/flag');
        }
        catch (Exeption $e) {
            return $e;
        }
    }
}
