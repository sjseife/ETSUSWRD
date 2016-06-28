<?php
/**
 * Created by PhpStorm.
 * User: Ryan
 * Date: 6/20/2016
 * Time: 9:35 PM
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Resource;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class ResourceController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    public function create()
    {
        return view('resource.create');
    }

    public function createResource()
    {
        $resource = new Resource(request()->all());
        $resource->save();
        return redirect('/home');
    }

    public function delete(Resource $id)
    {
        return view('resource.delete', compact('id'));
    }

    public function destroy($id)
    {
        try{
            DB::delete('delete from resource where id = "' . $id . '"');
            return redirect('/home');
        }
        catch (Exeption $e) {
            return $e;
        }
    }

    public function update(Resource $id)
    {
        return view('resource.update', compact('id'));
    }
    
    public function updateConfirm(Request $request, Resource $resource)
    {
        $updateArray = array("Name" => $request->Name);
           $resource->update($updateArray);
            return back();
    }    

    public function view(Resource $id)
    {
        return view('resource.view', compact('id'));
    }
}