<?php

namespace App\Http\Controllers;

use App\Flag;
use App\DailyHours;
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

class ResourcesController extends Controller
{
    public function index()
    {
        $resources = Resource::where('archived','=','0')->get();
        $categories = Category::lists('name');
        return view('resources.index', compact('resources', 'categories'));
    }

    public function show(Resource $resource)
    {
        //Incrementing view count when viewed
        app('App\Http\Controllers\ViewsController')->resourceView($resource);

        return view('resources.show', compact('resource'));
    }

    public function create()
    {
        $categoryList = Category::lists('name', 'id');
        $contactList = $this->getAllContactsFullName();
        return view('resources.create', compact('categoryList', 'contactList'));
    }

    public function store(ResourceRequest $request)
    {
        $resource = new Resource($request->all());
        $resource->save();
        $resource->contacts()->attach($request->input('contact_list'));

        //categories
        if(!is_null($request->input('category_list')))
        {
            $syncCategories = $this->checkForNewCategories($request->input('category_list'));
            $resource->categories()->attach($syncCategories);
        }

        //daily hours
        $dayArray = $request->day;
        $openArray = $request->open;
        $closeArray = $request->close;
        for($i = count($dayArray) - 1; $i >=0; $i--)
        {
            if($dayArray[$i] != "" && $openArray[$i] != "" && $closeArray[$i] != "")
            {
                $tempDay = DailyHours::create(['day'=>$dayArray[$i], "openTime"=>$openArray[$i],
                    'closeTime'=>$closeArray[$i], 'resource_id'=>$resource->id]);
            }
            else
            {
                flash('Problem creating operating hours. Please double check operating hours.', 'info');
            }
        }


        flash('Successfully created ' . $resource->name  , 'success');

        return redirect('resources');
    }

    public function edit(Resource $resource)
    {
        $categoryList = Category::lists('name', 'id');
        $contactList = $this->getAllContactsFullName();
        return view('resources.edit', compact('resource', 'categoryList', 'contactList'));
    }

    public function update(Resource $resource, ResourceRequest $request)
    {
        $resource->update($request->all());

        if(!is_null($request->input('contact_list')))
        {
            $resource->contacts()->sync($request->input('contact_list'));
        }
        else
        {
            $resource->contacts()->sync([]);
        }

        //daily hours
        DB::table('daily_hours')->where('resource_id', '=', $resource->id)->delete();//dump the old ones
        $dayArray = $request->day;
        $openArray = $request->open;
        $closeArray = $request->close;
        for($i = count($dayArray) - 1; $i >=0; $i--)
        {
            if($dayArray[$i] != "" && $openArray[$i] != "" && $closeArray[$i] != "")
            {
                $tempDay = DailyHours::create(['day'=>$dayArray[$i], "openTime"=>$openArray[$i],
                    'closeTime'=>$closeArray[$i], 'resource_id'=>$resource->id]);
            }
            else
            {
                flash('Problem creating operating hours. Please double check operating hours.', 'info');
            }
        }

        //categories
        if(!is_null($request->input('category_list')))
        {
            $syncCategories = $this->checkForNewCategories($request->input('category_list'));
            $resource->categories()->sync($syncCategories);
        }
        else
        {
            $resource->categories()->sync([]);
        }


        flash($resource->name . ' updated successfully!', 'success');
        return redirect('/resources/' . $resource->id);
    }
    
    public function destroy(Resource $resource)
    {
        if(Auth::user()->resources->contains($resource))
            Auth::user()->resources()->detach($resource);

        $resource->archived = '1';
        $resource->save();

       /* \Session::flash('flash_message', 'Resource Deleted');*/
        flash($resource->name . ' was deleted from resources!', 'success');
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

    public function add(Resource $resource, Request $request)
    {
        Auth::user()->resources()->syncWithoutDetaching([$resource->id]);
        if($request->ajax())
        {
            return response()->json(); //it just needs any JSON response to indicate a success.
        }
        else
        {
            flash($resource->name . 'added to Work List', 'success');
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
            flash( $resource->name.' removed from the Report.', 'success');
            return Redirect::back();
        }
    }

    /*
     * This method takes in a resource, compacts it into a "common flag format" and sends it to the flag.create view
     */
    public function flag(Resource $resource)
    {
        $options = ['Unselected' => 'Please Select a Reason.',
                'Update'=>'Resource information incorrect.',
                'Delete'=>'Resource has closed.'];
        return view('flags.create')->with('url', 'resources/flag/' . $resource->id)
                                   ->with('name', $resource->name)
                                   ->with('options', $options);
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

        flash('Flag Created Successfully!', 'success');

        return redirect('resources/'.$resource->id);
    }

    public function getAllContactsFullName()
    {
        $allContacts = Contact::all();
        $passedContacts = array();
        foreach($allContacts as $contact)
        {
            $fullname = $contact->full_name;
            $passedContacts[$contact->id] = $fullname;
        }
        return $passedContacts;
    }
}
