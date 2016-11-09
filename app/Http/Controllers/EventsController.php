<?php

namespace App\Http\Controllers;

use App\Event;
use App\Category;
use App\Contact;
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
        $events = Event::where('archived','=','0')->get();
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
        $contactList = Contact::lists('name', 'id');
        return view('events.create', compact('categoryList', 'contactList'));
    }

    public function store(EventRequest $request)
    {

        $event = new Event($request->all());
        $event->save();
        $event->contacts()->attach($request->input('contact_list'));

        //categories
        if(!is_null($request->input('category_list')))
        {
            $syncCategories = $this->checkForNewCategories($request->input('category_list'));
            $event->categories()->attach($syncCategories);
        }

        //daily hours
        $dayArray = $request->day;
        $openArray = $request->open;
        $closeArray = $request->close;
        $i = count($dayArray) - 1;
        for($i = count($dayArray) - 1; $i >=0; $i--)
        {
            if($dayArray[$i] != "" && $openArray[$i] != "" && $closeArray[$i] != "")
            {
                $tempDay = DailyHours::create(['day'=>$dayArray[$i], "openTime"=>$openArray[$i],
                    'closeTime'=>$closeArray[$i], 'event_id'=>$event->id]);
            }
            else
            {
                flash('Problem creating operating hours. Please double check operating hours.', 'info');
            }
        }

        flash( $event->name. ' created successfully!', 'success');

        return redirect('events');
    }

    public function edit(Event $event)
    {
        $categoryList = Category::lists('name', 'id');
        $contactList = Contact::lists('name', 'id');
        return view('events.edit', compact('event', 'categoryList', 'contactList'));
    }
    
    public function update(Event $event, EventRequest $request)
    {
        $event->update($request->all());

        if(!is_null($request->input('contact_list')))
        {
            $event->contacts()->sync($request->input('contact_list'));
        }
        else
        {
            $event->contacts()->sync([]);
        }

        //daily hours
        DB::table('daily_hours')->where('event_id', '=', $event->id)->delete(); //dump the old ones
        $dayArray = $request->day;
        $openArray = $request->open;
        $closeArray = $request->close;
        for($i = count($dayArray) - 1; $i >=0; $i--)
        {
            if($dayArray[$i] != "" && $openArray[$i] != "" && $closeArray[$i] != "")
            {
                $tempDay = DailyHours::create(['day'=>$dayArray[$i], "openTime"=>$openArray[$i],
                    'closeTime'=>$closeArray[$i], 'event_id'=>$event->id]);
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
            $event->categories()->sync($syncCategories);
        }
        else
        {
            $event->categories()->sync([]);
        }

        flash($event->name. ' updated successfully!', 'success');
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
        if(Auth::user()->events->contains($event))
            Auth::user()->events()->detach($event);

        $event->archived = '1';
        $event->save();


        flash($event->name. ' successfully deleted.', 'success');
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
            flash($event->name. ' added to Work List', 'success');
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
            flash( $event->name.' removed from the Report.', 'success');
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

        flash('Thank you for reporting the problem!', 'success');

        return redirect('events/'.$event->id);
    }
}
