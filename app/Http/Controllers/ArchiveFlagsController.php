<?php

namespace App\Http\Controllers;

use App\Flag;
use App\Http\Requests\FlagRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class ArchiveFlagsController extends Controller
{
    public function index()
    {
        $flags = Flag::where('resolved','=','1')->get();
        return view('archive_flags.index', compact('flags'));
    }

    public function show(Flag $flag)
    {
        //$flag = Flag::findOrFail($id);
        //Incrementing view count when viewed
        //app('App\Http\Controllers\ViewsController')->flagView($flag);

        return view('archive_flags.show', compact('flag'));
    }


    public function restore(Flag $flag, Request $request)
    {
        $flag->resolved = '0'; //set archived back to false
        $flag->save();

        if($request->ajax())
        {
            return response()->json(); //it just needs any JSON response to indicate a success.
        }
        else
        {
            \Session::flash('flash_message', 'Flag Added to Work List');
            return Redirect::back();
        }
    }

    public function removeReport(Flag $flag, Request $request)
    {
        Auth::user()->flags()->detach($flag);
        if($request->ajax())
        {
            return response()->json(); //it just needs any JSON response to indicate a success.
        }
        else
        {
            \Session::flash('flash_message', $flag->name.' removed from the Report.');
            return Redirect('/worklist/generateReport');
        }
    }

    public function showRestore(Flag $flag, Request $request)
    {
        $flag->resolved = '0'; //set resolved back to false
        $flag->save();

        flash('Flag was successfully restored to flags!', 'success');

        return redirect('/archive_flags');
    }

}