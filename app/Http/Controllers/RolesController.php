<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Http\Requests;
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

    public function store(Request $request)
    {
        //get old roles and Permissions
        $oldRoles = Role::where('name', '!=', 'System')
            ->where('name', '!=', 'Admin')
            ->get();
        $oldRolePermissions = $this->getRolesPermissionsNumber($oldRoles);
        $oldRoleNames = array();
        foreach($oldRoles as $role)
        {
            $oldRoleNames[$role->id] = $role->name;
        }

        //detect new and deleted
        $deletedAndChangedRoles = array_diff($oldRoleNames, $request->role);
        $newRoles = array_diff($request->range, $oldRolePermissions);
        dd($newRoles, $deletedAndChangedRoles);
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
        return response()->json(['id'=>$role->id]);
    }
}
