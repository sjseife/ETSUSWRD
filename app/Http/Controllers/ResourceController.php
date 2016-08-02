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
use App\Contact;
use App\Http\Requests;
use App\Resource;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Mockery\CountValidator\Exception;
use Illuminate\Contracts\Cache\Factory;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Support\Facades\Cache;

class ResourceController extends Controller
{
    public function index()
    {
        $resources = Resource::all();
        $flags = Flag::all();
        $contacts = Contact::all();
        // load the view and pass the resources
        return view('resource.index', compact('resources','flags','contacts'));
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

    public function add(Resource $id)
    {
        Cache::put($id->Id, $id->Id, 160);

        return redirect('/resource');
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

        $categories = Resource::where('id', $resource->id)->get();
        return view('resource.view', compact('resource'), compact('categories'));
    }

    public function generateReport()
    {
        $resources = [];

        foreach (Resource::all() as $r) {
            $num = ($r->Id);
            if (cache::has($num))
            {
                $resources[$num] = $r;
            }
        }

        return view('resource.generateReport', compact('resources'));
    }

    public function removeCart($id)
    {
        cache::forget($id);

        return redirect('/resource/generateReport');

    }


    public function generatePDF()
    {
        $resources = [];

        foreach (Resource::all() as $r) {
            $num = ($r->Id);
            if (cache::has($num))
            {
                $resources[$num] = $r;
            }
        }

        $pdf = App::make('dompdf.wrapper');

        $view = View::make('resource.pdfHeader')->with('resources', $resources);
        $contents = $view->render();

        $pdf->loadHTML($contents);
        return $pdf->stream();
    }


}