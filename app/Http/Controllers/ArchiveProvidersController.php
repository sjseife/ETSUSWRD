<?php

namespace App\Http\Controllers;

use App\Provider;
use App\Contact;
use App\Flag;
use App\Http\Requests\ProviderRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\FlagRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArchiveProvidersController extends Controller
{
    public function index()
    {
        $providers = Provider::where('archived','=','1')->get();
        return view('archive_providers.index', compact('providers'));
    }

    public function show(Provider $provider)
    {
        //$provider = Provider::findOrFail($id);
        //Incrementing view count when viewed
        //app('App\Http\Controllers\ViewsController')->providerView($provider);

        return view('archive_providers.show', compact('provider'));
    }


    public function restore(Provider $provider, Request $request)
    {
        $provider->archived = '0'; //set archived back to false
        $provider->save();

        if($request->ajax())
        {
            return response()->json(); //it just needs any JSON response to indicate a success.
        }
        else
        {
            \Session::flash('flash_message', 'Provider Added to Work List');
            return Redirect::back();
        }
    }

    public function removeReport(Provider $provider, Request $request)
    {
        Auth::user()->providers()->detach($provider);
        if($request->ajax())
        {
            return response()->json(); //it just needs any JSON response to indicate a success.
        }
        else
        {
            \Session::flash('flash_message', $provider->name.' removed from the Report.');
            return Redirect('/worklist/generateReport');
        }
    }

    public function showRestore(Provider $provider, Request $request)
    {
        $provider->archived = '0'; //set archived back to false
        $provider->save();

        \Session::flash('flash_message', 'Provider Restored');
        return redirect('/archive_providers');
    }

}
