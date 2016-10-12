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

class ResourcesController extends Controller
{
    public function index()
    {
        $resources = Resource::all();
        $categories = Category::lists('name');
        return view('resources.index', compact('resources', 'categories'));
    }

    public function show(Resource $resource)
    {
        //$resource = Resource::findOrFail($id);
        //Incrementing view count when viewed
        app('App\Http\Controllers\ViewsController')->resourceView($resource);

        return view('resources.show', compact('resource'));
    }

    public function create()
    {
        $categoryList = Category::lists('name', 'id');
        $providerList = Provider::lists('name', 'id');
        return view('resources.create', compact('categoryList', 'providerList'));
    }

    public function store(ResourceRequest $request)
    {
        $resource = new Resource($request->all());
        $resource->provider_id = $request->provider;
        $resource->save();
        if(!is_null($request->input('category_list')))
        {
            $syncCategories = $this->checkForNewCategories($request->input('category_list'));
            $resource->categories()->attach($syncCategories);
        }
        //create and sync daily hours if the resource is not closed that day
        if(!isset($request->mondayClosedCheck))
        {
            $monday = DailyHours::create(['day'=>'Monday', 'openTime'=>$request->mondayOpen,
                                'closeTime'=>$request->mondayClose, 'resource_id'=>$resource->id]);
        }
        if(!isset($request->tuesdayClosedCheck))
        {
            $tuesday = DailyHours::create(['day'=>'Tuesday', 'openTime'=>$request->tuesdayOpen,
                'closeTime'=>$request->tuesdayClose, 'resource_id'=>$resource->id]);
        }
        if(!isset($request->wednesdayClosedCheck))
        {
            $wednesday = DailyHours::create(['day'=>'Wednesday', 'openTime'=>$request->wednesdayOpen,
                'closeTime'=>$request->wednesdayClose, 'resource_id'=>$resource->id]);
        }
        if(!isset($request->thursdayClosedCheck))
        {
            $thursday = DailyHours::create(['day'=>'Thursday', 'openTime'=>$request->thursdayOpen,
                'closeTime'=>$request->thursdayClose, 'resource_id'=>$resource->id]);
        }
        if(!isset($request->fridayClosedCheck))
        {
            $friday = DailyHours::create(['day'=>'Friday', 'openTime'=>$request->fridayOpen,
                'closeTime'=>$request->fridayClose, 'resource_id'=>$resource->id]);
        }
        if(!isset($request->saturdayClosedCheck))
        {
            $saturday = DailyHours::create(['day'=>'Saturday', 'openTime'=>$request->saturdayOpen,
                'closeTime'=>$request->saturdayClose, 'resource_id'=>$resource->id]);
        }
        if(!isset($request->sundayClosedCheck))
        {
            $sunday = DailyHours::create(['day'=>'Sunday', 'openTime'=>$request->sundayOpen,
                'closeTime'=>$request->sundayClose, 'resource_id'=>$resource->id]);
        }

        \Session::flash('flash_message', 'Resource Created Successfully!');

        return redirect('resources');
    }

    public function edit(Resource $resource)
    {
        $categoryList = Category::lists('name', 'id');
        $providerList = Provider::lists('name', 'id');
        return view('resources.edit', compact('resource', 'categoryList', 'providerList'));
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
                    'provider_id' => $flag->providerIdNumber,
                    'event_id' => $flag->eventIdNumber,
                    'created_at' => $flag->created_at,
                    'updated_at' => $flag->updated_at,
                    'archived_at' => Carbon::now()->format('Y-m-d H:i:s')]
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
        foreach($resource->hours as $hours)
        {
            DB::table('archive_daily_hours')->insert(
                [
                    'id' => $hours->id,
                    'day' => $hours->day,
                    'openTime' => $hours->openTime,
                    'closeTime' => $hours->closeTime,
                    'resource_id' => $hours->resource_id,
                    'event_id' => $hours->event_id,
                    'created_at' => $hours->created_at,
                    'updated_at' => $hours->updated_at,
                    'archived_at' => Carbon::now()->format('Y-m-d H:i:s')
                ]
            );
        }
        DB::table('archive_resources')->insert(
          [
              'id' => $resource->id,
              'name' => $resource->name,
              'streetAddress' => $resource->streetAddress,
              'streetAddress2' => $resource->streetAddress2,
              'city' => $resource->city,
              'county' => $resource->county,
              'state' => $resource->state,
              'zipCode' => $resource->zipCode,
              'publicPhoneNumber' => $resource->publicPhoneNumber,
              'publicEmail' => $resource->publicEmail,
              'website' => $resource->website,
              'description' => $resource->description,
              'comments' => $resource->comments,
              'provider_id' => $resource->provider_id,
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

    public function add(Resource $resource, Request $request)
    {
        Auth::user()->resources()->syncWithoutDetaching([$resource->id]);
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
            \Session::flash('flash_message', 'Resource Removed from Report');
            return Redirect::back();
        }
    }

    /*
     * This method takes in a resource, compacts it into a "common flag format" and sends it to the flag.create view
     */
    public function flag(Resource $resource)
    {
        return view('flags.create')->with('url', 'resources/flag/' . $resource->id)
                                   ->with('name', $resource->name);
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
