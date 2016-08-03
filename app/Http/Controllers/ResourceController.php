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
use App\Http\Requests\ResourceRequest;
use App\Http\Requests\Request;
use App\Resource;
use Illuminate\Support\Facades\DB;
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

    public function store(ResourceRequest $request)
    {
        $syncCategories = $this->checkForNewCategories($request->input('category_list'));
        $resource = new Resource($request->all());
        $resource->save();
        $resource->categories()->attach($syncCategories);

        \Session::flash('flash_message', 'Resource Created Successfully!');

        return redirect('resources');
    }

    protected function checkForNewCategories(array $requestCategories)
    {
        //all categories, and requested categories
        $allCategories = Category::lists('id')->toArray();
        //seperated
        $newCategories = array_diff($requestCategories, $allCategories); //categories to be added to DB
        $syncCategories = array_diff($requestCategories, $newCategories); //categories already in DB

        foreach ($newCategories as $newCategory)
        {
            $newCategoryModel = Category::create(['name' => $newCategory]);
            $syncCategories[] = "".$newCategoryModel->id;
        }

        return $syncCategories;
    }

    public function delete(Resource $resource)
    {
        return view('resource.delete', compact('resource'));
    }

    public function destroy(Resource $resource)
    {
        try{
            DB::delete('delete from resource where id = "' . $resource->Id . '"');
            \Session::flash('flash_message', 'Resource Deleted');
            return redirect('/resources');
        }
        catch (Exeption $e) {
            return $e;
        }
    }

    public function add(Resource $resource)
    {
        Cache::put($resource->Id, $resource->Id, 160);

        return redirect('/resources');
    }

    public function edit(Resource $resource)
    {
        $categoryList = Category::lists('name', 'id');
        return view('resource.edit', compact('resource'), compact('categoryList'));
    }

    public function update(Resource $resource, ResourceRequest $request)
    {
        $syncCategories = $this->checkForNewCategories($request->input('category_list'));
        $resource->update($request->all());
        $resource->categories()->sync($syncCategories);
        \Session::flash('flash_message', 'Resource Updated Successfully!');
        return redirect('/resources/' . $resource->id);
    }

    public function show(Resource $resource)
    {
        //$resource = Resource::findOrFail($id);
        return view('resource.show', compact('resource'));
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