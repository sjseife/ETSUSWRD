<?php

namespace App\Http\Controllers;

use App\Flag;
use App\Http\Requests\FlagRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ContactRequest;
use App\Contact;
use Auth;
use Illuminate\Support\Facades\DB;

class ArchiveContactsController extends Controller
{
    public function index()
    {
        $contacts = Contact::where('archived','=','1')->get();
        return view('archive_contacts.index', compact('contacts'));
    }

    public function show(Contact $contact)
    {
        //$contact = Contact::findOrFail($id);
        //Incrementing view count when viewed
        //app('App\Http\Controllers\ViewsController')->contactView($contact);

        return view('archive_contacts.show', compact('contact'));
    }


    public function restore(Contact $contact, Request $request)
    {
        $contact->archived = '0'; //set archived back to false
        $contact->save();

        if($request->ajax())
        {
            return response()->json(); //it just needs any JSON response to indicate a success.
        }
        else
        {
            \Session::flash('flash_message', 'Contact Added to Work List');
            return Redirect::back();
        }
    }

    public function removeReport(Contact $contact, Request $request)
    {
        Auth::user()->contacts()->detach($contact);
        if($request->ajax())
        {
            return response()->json(); //it just needs any JSON response to indicate a success.
        }
        else
        {
            \Session::flash('flash_message', $contact->name.' removed from the Report.');
            return Redirect('/worklist/generateReport');
        }
    }

    public function showRestore(Contact $contact, Request $request)
    {
        $contact->archived = '0'; //set archived back to false
        $contact->save();

        flash($contact->firstName . ' ' . $contact->lastName . ' was restored to contacts!', 'success');

        return redirect('/archive_contacts');
    }

}
