<?php

namespace App\Http\Controllers;

use App\Flag;
use App\Http\Requests\FlagRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ResourceRequest;
use App\Resource;
use App\Category;
use App\Contact;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;

class ResourcesController extends Controller
{
    public function index()
    {
        $resources = Resource::all();
        return view('resources.index', compact('resources'));
    }

    public function show(Resource $resource)
    {
        //$resource = Resource::findOrFail($id);
        return view('resources.show', compact('resource'));
    }

    public function create()
    {
        $categoryList = Category::lists('name', 'id');
        $passedContacts = $this->getAllContactsFullName();
        $resourceList = Resource::lists('name', 'id');
        return view('resources.create', compact('categoryList', 'passedContacts', 'resourceList'));
    }

    public function store(ResourceRequest $request)
    {
        $resource = new Resource($request->all());
        $resource->save();
        if(!is_null($request->input('category_list')))
        {
            $syncCategories = $this->checkForNewCategories($request->input('category_list'));
            $resource->categories()->attach($syncCategories);
        }
        $resource->contacts()->attach($request->input('contact_list'));

        \Session::flash('flash_message', 'Resource Created Successfully!');

        return redirect('resources');
    }

    public function edit(Resource $resource)
    {
        $categoryList = Category::lists('name', 'id');
        $passedContacts = $this->getAllContactsFullName();
        $resourceList = Resource::lists('name', 'id');
        return view('resources.edit', compact('resource', 'categoryList', 'passedContacts', 'resourceList'));
    }

    public function update(Resource $resource, ResourceRequest $request)
    {
        $resource->update($request->all());
        if(!is_null($request->input('category_list')))
        {
            $syncCategories = $this->checkForNewCategories($request->input('category_list'));
            $resource->categories()->sync($syncCategories);
        }
        else
        {
            $resource->categories()->sync([]);
        }
        if(!is_null($request->input('contact_list')))
        {
            $resource->contacts()->sync($request->input('contact_list'));
        }
        else
        {
            $resource->contacts()->sync([]);
        }
        \Session::flash('flash_message', 'Resource Updated Successfully!');
        return redirect('/resources/' . $resource->id);
    }
    
    public function destroy(Resource $resource)
    {
        foreach($resource->flags as $flag)
        {
            DB::table('archive_flags')->insert(
                ['id' => $flag->id,
                    'level' => $flag->level,
                    'comments' => $flag->comments,
                    'resolved' => $flag->resolved,
                    'submitted_by' => $flag->submitter->id,
                    'user_id' => $flag->userIdNumber,
                    'resource_id' => $flag->resourceIdNumber,
                    'contact_id' => $flag->contactIdNumber,
                    'created_at' => $flag->created_at,
                    'updated_at' => $flag->updated_at,
                    'archived_at' => Carbon::now()->format('Y-m-d H:i:s')]
            );
        }
        foreach($resource->contacts as $contact)
        {
            DB::table('archive_contact_resource')->insert(
                [
                    'contact_id' => $contact->pivot->contact_id,
                    'resource_id' => $resource->id,
                    'created_at' => $contact->pivot->created_at,
                    'updated_at' => $contact->pivot->updated_at,
                    'archived_at' => Carbon::now()->format('Y-m-d H:i:s')
                ]
            );
        }
        foreach($resource->categories as $category)
        {
            DB::table('archive_category_resource')->insert(
                [
                    'category_id' => $category->pivot->category_id,
                    'resource_id' => $resource->id,
                    'created_at' => $category->pivot->created_at,
                    'updated_at' => $category->pivot->updated_at,
                    'archived_at' => Carbon::now()->format('Y-m-d H:i:s')
                ]
            );
        }
        foreach($resource->users as $user)
        {
            DB::table('archive_resource_user')->insert(
                [
                    'user_id' => $user->pivot->user_id,
                    'resource_id' => $resource->id,
                    'created_at' => $user->pivot->created_at,
                    'updated_at' => $user->pivot->updated_at,
                    'archived_at' => Carbon::now()->format('Y-m-d H:i:s')
                ]
            );
        }
        DB::table('archive_resources')->insert(
          ['id' => $resource->id,
            'Name' => $resource->Name,
            'StreetAddress' => $resource->StreetAddress,
            'StreetAddress2' => $resource->StreetAddress2,
            'City' => $resource->City,
            'County' => $resource->County,
            'State' => $resource->State,
            'Zipcode' => $resource->Zipcode,
            'PhoneNumber' => $resource->PhoneNumber,
            'OpeningHours' => $resource->OpeningHours,
              'ClosingHours' => $resource->ClosingHours,
              'Comments' => $resource->Comments,
              'created_at' => $resource->created_at,
              'updated_at' => $resource->updated_at,
              'archived_at' => Carbon::now()->format('Y-m-d H:i:s')]
        );
        $resource->delete();
        \Session::flash('flash_message', 'Resource Deleted');
        return redirect('/resources');
    }

    protected function checkForNewCategories(array $requestCategories)
    {
        //all categories, and requested categories
        $allCategories = Category::lists('id')->toArray();
        //Categorize the Categories
        $newCategories = array_diff($requestCategories, $allCategories); //categories to be added to DB
        $syncCategories = array_diff($requestCategories, $newCategories); //categories already in DB

        foreach ($newCategories as $newCategory)
        {
            $newCategoryModel = Category::create(['name' => $newCategory]);
            $syncCategories[] = "".$newCategoryModel->id;
        }

        return $syncCategories;
    }

    public function getAllContactsFullName()
    {
        $allContacts = Contact::all();
        $passedContacts = array();
        foreach($allContacts as $contact)
        {
            $fullname = ucfirst($contact->firstName). ' ' . ucfirst($contact->lastName);
            $passedContacts[$contact->id] = $fullname;
        }

        return $passedContacts;
    }

    public function add(Resource $resource)
    {
        Auth::user()->resources()->syncWithoutDetaching([$resource->id]);
        \Session::flash('flash_message', 'Resource Added to Report');
        return Redirect::back();
    }

    public function generateReport()
    {
        $resources = Auth::user()->resources;
        return view('resources.generateReport', compact('resources'));
    }

    public function removeReport(Resource $resource)
    {
        Auth::user()->resources()->detach($resource);
        return redirect('/resources/generateReport');
    }

    public function emptyReport()
    {
        Auth::user()->resources()->detach();
        return Redirect::back();
    }

    public function generatePDF()
    {
        $pdf = App::make('dompdf.wrapper');
        $view = View::make('resources.pdfHeader')->with('resources', Auth::user()->resources);
        $contents = $view->render();
        $pdf->loadHTML($contents);
        return $pdf->stream();
    }


    /*
     * This method takes in a resource, compacts it into a "common flag format" and sends it to the flag.create view
     */
    public function flag(Resource $resource)
    {
        return view('flags.create')->with('url', 'resources/flag/' . $resource->id)
                                   ->with('name', $resource->Name);
    }

    public function storeFlag(Resource $resource, FlagRequest $request)
    {
        $flagData = ['level' => $request->level,
                    'comments' => $request->comments,
                    'resolved' => '0',
                    'resource_id' => $resource->id,
                    'submitted_by' => Auth::id()];
        $flag = new Flag($flagData);
        $flag->save();

        \Session::flash('flash_message', 'Flag Created Successfully!');

        return redirect('resources/'.$resource->id);
    }
}
