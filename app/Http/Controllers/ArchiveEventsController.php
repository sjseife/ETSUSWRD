<?php

namespace App\Http\Controllers;

use App\Event;
use App\ArchiveEvent;
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

class ArchiveEventsController extends Controller
{
    public function index()
    {
        $events = Event::where('archived','=','1')->get();
        $categories = Category::lists('name');
        return view('archive_events.index', compact('events', 'categories'));
    }

    public function show(Event $event)
    {
        //$event = Event::findOrFail($id);
        //Incrementing view count when viewed
        //app('App\Http\Controllers\ViewsController')->eventView($event);

        return view('events.show', compact('event'));
    }





    public function edit(Event $event)
    {
        $categoryList = Category::lists('name', 'id');
        $providerList = Provider::lists('name', 'id');
        return view('events.edit', compact('event', 'categoryList', 'providerList'));
    }



    public function restore(Event $event, Request $request)
    {
        $event->archived = '0'; //set archived back to false
        $event->save();

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
            \Session::flash('flash_message', $event->name.' removed from the Report.');
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
