<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Http\Requests\RoleRequest;
use App\Http\Controllers\Controller;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Role::where('name', '!=', 'System')
                    ->where('name', '!=', 'Admin')
                    ->get();
        $rolePermissions = $this->getRolesPermissionsNumber($roles);
        return view('roles.index', compact('roles', 'rolePermissions'));
    }

    public function store(RoleRequest $request)
    {
        $roles = Role::where('name', '!=', 'System')
            ->where('name', '!=', 'Admin')
            ->get();
        foreach($roles as $role)
        {
            if(!isset($request->get('role')[$role->id]))
            {
                Role::where('id', '=', $role->id)->delete();
            }
        }
        foreach ($request->get('role') as $rk => $rv){
            $theRole = Role::where('id', '=', $rk)->first();
            $rangev = $request->get('range')[$rk];
            $base = '0';
            $extended = '0';
            $createupdate = '0';
            $delete = '0';
            $archive = '0';
            $users = '0';
            $roles = '0';
            if((int)$rangev >= 1){
                $base = '1';
            }
            if((int)$rangev > 1){
                $extended = '1';
            }
            if((int)$rangev > 2){
                $createupdate = '1';
            }
            if((int)$rangev > 3){
                $delete = '1';
            }
            if((int)$rangev > 4){
                $archive = '1';
            }
            if((int)$rangev > 5){
                $users = '1';
            }
            if((int)$rangev > 6){
                $roles = '1';
            }
            Role::where('id', '=', $theRole->id)->update([
                    'name' => $rv,
                    'base' => $base,
                    'extended' => $extended,
                    'create_update' => $createupdate,
                    'delete' => $delete,
                    'archive' => $archive,
                    'users' => $users,
                    'roles' => $roles
                ]);
        }

        $roles = Role::where('name', '!=', 'System')
            ->where('name', '!=', 'Admin')
            ->get();
        $rolePermissions = $this->getRolesPermissionsNumber($roles);

        flash('Roles Updated Successfully!', 'success');
        return view('roles.index', compact('roles', 'rolePermissions'));
     }

    public function getRolesPermissionsNumber($roles)
    {
        $rolePermissions = Array();
        foreach($roles as $role)
        {
            if($role->roles == '1')
                $rolePermissions[$role->id] = 7;
            elseif($role->users == '1')
                $rolePermissions[$role->id] = 6;
            elseif($role->archive == '1')
                $rolePermissions[$role->id] = 5;
            elseif($role->delete == '1')
                $rolePermissions[$role->id] = 4;
            elseif($role->create_update == '1')
                $rolePermissions[$role->id] = 3;
            elseif($role->extendec == '1')
                $rolePermissions[$role->id] = 2;
            elseif($role->base == '1')
                $rolePermissions[$role->id] = 1;
            else
                $rolePermissions[$role->id] = 0;
        }
        return $rolePermissions;
    }

    public function createNew(Request $request)
    {
        $roleProperties = ['name' => $request->name,
                            'base' => '0',
                            'extended' => '0',
                            'create_update' => '0',
                            'delete' => '0',
                            'archive' => '0',
                            'users' => '0',
                            'roles' => '0'];
        $role = new Role($roleProperties);
        $role->save();
        return response()->json(['id'=>$role->id, 'name'=>$role->name]);
    }
}
