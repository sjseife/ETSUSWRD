<?php

namespace App\Http\Controllers;

use App\Flag;
use App\DailyHours;
use App\Provider;
use App\Http\Requests\FlagRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ResourceRequest;
use App\Resource;
use App\Category;
use App\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;

class ArchiveResourcesController extends Controller
{
    public function index()
    {
        $resources = Resource::where('archived','=','1')->get();
        $categories = Category::lists('name');
        return view('archive_resources.index', compact('resources', 'categories'));
    }

    public function show(Resource $resource)
    {
        //$resource = Resource::findOrFail($id);
        //Incrementing view count when viewed
       app('App\Http\Controllers\ViewsController')->resourceView($resource);

        return view('archive_resources.show', compact('resource'));
    }


    public function restore(Resource $resource, Request $request)
    {
        $resource->archived = '0'; //set archived back to false
        $resource->save();

        if($request->ajax())
        {
            return response()->json(); //it just needs any JSON response to indicate a success.
        }
        else
        {
            \Session::flash('flash_message', 'Resource Added to Work List');
            return Redirect::back();
        }
    }

    public function removeReport(Resource $resource, Request $request)
    {
        Auth::user()->resources()->detach($resource);
        if($request->ajax())
        {
            return response()->json(); //it just needs any JSON response to indicate a success.
        }
        else
        {
            \Session::flash('flash_message', $resource->name.' removed from the Report.');
            return Redirect('/worklist/generateReport');
        }
    }

    public function showRestore(Resource $resource, Request $request)
    {
        $resource->archived = '0'; //set archived back to false
        $resource->save();

        flash($resource->name . ' was restored to resources!', 'success');
        return redirect('/archive_resources');
    }

}
