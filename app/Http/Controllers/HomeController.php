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
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();
        $categories = Category::lists('name');


        $upcomingEvents = array();
           $now= Carbon::now();

          foreach ($events as $event)
           {
               $endBool = false;

               $start = new Carbon($event->startDate);
               $tempStartDiff = ($start->diffInDays($now));

               $end = new Carbon($event->endDate);
               if ($end->gt($now)) { $endBool = true; }
               $tempEndDiff = ($end->diffInDays($now));

              if(($tempStartDiff  < 6)   && ($endBool))
               {
                   $upcomingEvents[] = $event;
               }
           }


        return view('home', compact('categories', 'upcomingEvents'));
    }

    public function errorGA()
    {
        return view('errors.401GA');
    }

    public function errorAdmin()
    {
        return view('errors.401Admin');
    }
}
