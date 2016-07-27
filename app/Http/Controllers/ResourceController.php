<?php
/**
 * Created by PhpStorm.
 * User: Ryan
 * Date: 6/20/2016
 * Time: 9:35 PM
 */

namespace App\Http\Controllers;

use App\Category;
use App\Flag;
use App\Http\Requests;
use App\Resource;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;


class ResourceController extends Controller
{
    public function index()
    {
        $resources = Resource::all();
        $flags = Flag::all();
        // load the view and pass the resources
        return view('resource.index')
            ->with('resources', $resources)->with('flag', $flags);
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create()
    {
        $categoryList = Category::lists('name', 'id');
        return view('resource.create', compact('categoryList'));
    }

    public function createResource()
    {
        $resource = new Resource(request()->all());
        $resource->save();
        $categoryIds = request()->input('categories');
        $resource->categories()->attach($categoryIds);

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

    public function edit(Resource $id)
    {
        return view('resource.edit', compact('id'));
    }
    
    public function update(Request $request, Resource $id)
    {
        unset($request['_method']);
        unset($request['_token']);
        Resource::where('Id', $id->Id)
                ->update($request->all());
        return back();
    }    

    public function view(Resource $resource)
    {
        return view('resource.view', compact('resource'));
    }
    
    public function generateReport()
    {
        //This will be replaced with session cart data -> $resources = Session::all();
        $resources = Resource::all();
        
        return view('resource.generateReport')
            ->with('resources', $resources);
    }

    public function generatePDF()
    {
        //This will be replaced with session cart data -> $resources = Session::all();
        $resources = Resource::all();

        $pdf = App::make('dompdf.wrapper');

        $view = View::make('resource.pdfHeader')->with('resources', $resources);
        $contents = $view->render();

        $pdf->loadHTML($contents);
        return $pdf->stream();
    }


}