<?php

namespace App\Http\Controllers;

use App\Event;
use App\Category;
use App\Provider;
use App\DailyHours;
use App\Flag;
use App\Http\Requests\EventRequest;
use App\Http\Requests\FlagRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class EventsController extends Controller
{
    public function index()
    {
        $events = Event::all();
        $categories = Category::lists('name');
        return view('events.index', compact('events', 'categories'));
    }

    public function show(Event $event)
    {
        //$event = Event::findOrFail($id);
        //Incrementing view count when viewed
        //app('App\Http\Controllers\ViewsController')->eventView($event);

        return view('events.show', compact('event'));
    }

    public function create()
    {
        $categoryList = Category::lists('name', 'id');
        $providerList = Provider::lists('name', 'id');
        return view('events.create', compact('categoryList', 'providerList'));
    }

    public function store(EventRequest $request)
    {
        $event = new Event($request->all());
        $event->provider_id = $request->provider;
        $event->save();
        if(!is_null($request->input('category_list')))
        {
            $syncCategories = $this->checkForNewCategories($request->input('category_list'));
            $event->categories()->attach($syncCategories);
        }
        //create and sync daily hours if the event is not closed that day
        if(!isset($request->mondayClosedCheck))
        {
            $monday = DailyHours::create(['day'=>'Monday', 'openTime'=>$request->mondayOpen,
                'closeTime'=>$request->mondayClose, 'event_id'=>$event->id]);
        }
        if(!isset($request->tuesdayClosedCheck))
        {
            $tuesday = DailyHours::create(['day'=>'Tuesday', 'openTime'=>$request->tuesdayOpen,
                'closeTime'=>$request->tuesdayClose, 'event_id'=>$event->id]);
        }
        if(!isset($request->wednesdayClosedCheck))
        {
            $wednesday = DailyHours::create(['day'=>'Wednesday', 'openTime'=>$request->wednesdayOpen,
                'closeTime'=>$request->wednesdayClose, 'event_id'=>$event->id]);
        }
        if(!isset($request->thursdayClosedCheck))
        {
            $thursday = DailyHours::create(['day'=>'Thursday', 'openTime'=>$request->thursdayOpen,
                'closeTime'=>$request->thursdayClose, 'event_id'=>$event->id]);
        }
        if(!isset($request->fridayClosedCheck))
        {
            $friday = DailyHours::create(['day'=>'Friday', 'openTime'=>$request->fridayOpen,
                'closeTime'=>$request->fridayClose, 'event_id'=>$event->id]);
        }
        if(!isset($request->saturdayClosedCheck))
        {
            $saturday = DailyHours::create(['day'=>'Saturday', 'openTime'=>$request->saturdayOpen,
                'closeTime'=>$request->saturdayClose, 'event_id'=>$event->id]);
        }
        if(!isset($request->sundayClosedCheck))
        {
            $sunday = DailyHours::create(['day'=>'Sunday', 'openTime'=>$request->sundayOpen,
                'closeTime'=>$request->sundayClose, 'event_id'=>$event->id]);
        }

        \Session::flash('flash_message', 'Event Created Successfully!');

        return redirect('events');
    }

    public function edit(Event $event)
    {
        $categoryList = Category::lists('name', 'id');
        $providerList = Provider::lists('name', 'id');
        return view('events.edit', compact('event', 'categoryList', 'providerList'));
    }
    
    public function update(Event $event, EventRequest $request)
    {
        $event->update($request->all());
        if(!is_null($request->input('category_list')))
        {
            $syncCategories = $this->checkForNewCategories($request->input('category_list'));
            $event->categories()->sync($syncCategories);
        }
        else
        {
            $event->categories()->sync([]);
        }
        \Session::flash('flash_message', 'Event Updated Successfully!');
        return redirect('/events/' . $event->id);
    }

    protected function checkForNewCategories(array $requestCategories)
    {
        //all categories that currently exist in the DB
        $allCategories = Category::lists('id')->toArray();
        //Categorize the Categories
        $newCategories = array_diff($requestCategories, $allCategories); //categories to be added to DB
        $syncCategories = array_diff($requestCategories, $newCategories); //categories already in DB

        //add new categories to DB, and transfer them to syncCategories
        foreach ($newCategories as $newCategory)
        {
            $newCategoryModel = Category::create(['name' => $newCategory]);
            $syncCategories[] = "".$newCategoryModel->id;
        }

        return $syncCategories;
    }

    public function destroy(Event $event)
    {
        foreach($event->flags as $flag)
        {
            DB::table('archive_flags')->insert(
                ['id' => $flag->id,
                    'level' => $flag->level,
                    'comments' => $flag->comments,
                    'resolved' => $flag->resolved,
                    'submitted_by' => $flag->submitter->id,
                    'user_id' => $flag->userIdNumber,
                    'event_id' => $flag->eventIdNumber,
                    'contact_id' => $flag->contactIdNumber,
                    'provider_id' => $flag->providerIdNumber,
                    'resource_id' => $flag->resourceIdNumber,
                    'created_at' => $flag->created_at,
                    'updated_at' => $flag->updated_at,
                    'archived_at' => Carbon::now()->format('Y-m-d H:i:s')]
            );
        }
        foreach($event->categories as $category)
        {
            DB::table('archive_category_event')->insert(
                [
                    'category_id' => $category->pivot->category_id,
                    'event_id' => $event->id,
                    'created_at' => $category->pivot->created_at,
                    'updated_at' => $category->pivot->updated_at,
                    'archived_at' => Carbon::now()->format('Y-m-d H:i:s')
                ]
            );
        }
        foreach($event->users as $user)
        {
            DB::table('archive_event_user')->insert(
                [
                    'user_id' => $user->pivot->user_id,
                    'event_id' => $event->id,
                    'created_at' => $user->pivot->created_at,
                    'updated_at' => $user->pivot->updated_at,
                    'archived_at' => Carbon::now()->format('Y-m-d H:i:s')
                ]
            );
        }
        foreach($event->hours as $hours)
        {
            DB::table('archive_daily_hours')->insert(
                [
                    'id' => $hours->id,
                    'day' => $hours->day,
                    'openTime' => $hours->openTime,
                    'closeTime' => $hours->closeTime,
                    'event_id' => $hours->event_id,
                    'resource_id' => $hours->resource_id,
                    'created_at' => $hours->created_at,
                    'updated_at' => $hours->updated_at,
                    'archived_at' => Carbon::now()->format('Y-m-d H:i:s')
                ]
            );
        }
        DB::table('archive_events')->insert(
            [
                'id' => $event->id,
                'name' => $event->name,
                'startDate' => $event->startDate,
                'endDate' => $event->endDate,
                'streetAddress' => $event->streetAddress,
                'streetAddress2' => $event->streetAddress2,
                'city' => $event->city,
                'county' => $event->county,
                'state' => $event->state,
                'zipCode' => $event->zipCode,
                'publicPhoneNumber' => $event->publicPhoneNumber,
                'publicEmail' => $event->publicEmail,
                'website' => $event->website,
                'description' => $event->description,
                'comments' => $event->comments,
                'provider_id' => $event->provider_id,
                'created_at' => $event->created_at,
                'updated_at' => $event->updated_at,
                'archived_at' => Carbon::now()->format('Y-m-d H:i:s')]
        );
        $event->delete();
        \Session::flash('flash_message', 'Event Deleted');
        return redirect('/events');
    }

    public function add(Event $event, Request $request)
    {
        Auth::user()->events()->syncWithoutDetaching([$event->id]);
        if($request->ajax())
        {
            return response()->json(); //it just needs any JSON response to indicate a success.
        }
        else
        {
            \Session::flash('flash_message', 'Event Added to Work List');
            return Redirect::back();
        }
    }

    public function removeReport(Event $event, Request $request)
    {
        Auth::user()->events()->detach($event);
        if($request->ajax())
        {
            return response()->json(); //it just needs any JSON response to indicate a success.
        }
        else
        {
            \Session::flash('flash_message', 'Event Removed from Report');
            return Redirect('/worklist/generateReport');
        }
    }

    /*
     * This method takes in a event, compacts it into a "common flag format" and sends it to the flag.create view
     */
    public function flag(Event $event)
    {
        return view('flags.create')->with('url', 'events/flag/' . $event->id)
            ->with('name', $event->name);
    }

    public function storeFlag(Event $event, FlagRequest $request)
    {
        $flagData = ['level' => $request->level,
            'comments' => $request->comments,
            'resolved' => '0',
            'event_id' => $event->id,
            'submitted_by' => Auth::id()];
        $flag = new Flag($flagData);
        $flag->save();

        \Session::flash('flash_message', 'Thank you for reporting the problem!');

        return redirect('events/'.$event->id);
    }
}
