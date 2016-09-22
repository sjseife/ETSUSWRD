<?php

namespace App\Http\Controllers;

use App\Flag;
use App\Http\Requests\FlagRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ContactRequest;
use App\Contact;
use App\Resource;
use Auth;
use Illuminate\Support\Facades\DB;

class ContactsController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return view('contacts.index', compact('contacts'));
    }

    public function show(Contact $contact)
    {
        return view('contacts.show', compact('contact'));
    }
    public function create()
    {
        $resourceList = Resource::lists('name', 'id');
        return view('contacts.create', compact('resourceList'));
    }

    public function store(ContactRequest $request)
    {
        //other validation is done in ContactRequest, this simply checks that the email is unique
        $this->validate($request,
            ['email' => 'unique:contacts']);
        $contact= new Contact($request->all());
        $contact->save();
        $contact->resources()->attach($request->input('resource_list'));

        \Session::flash('flash_message', 'Contact Created Successfully!');

        return redirect('contacts');
    }

    /*
     * Same as regular store, except it returns JSON. For some reason I would get tokenmismatch exceptions if I left
     * the data input as ContactRequest. As a result, data validation now happens entirely within the method.
     * This is planned to be used when creating a new resource so that the contact can be created from the same page using aJax
     */
    public function storeJSON(Request $request)
    {
        $this->validate($request,
            ['firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|unique:contacts',
            'phoneNumber' => 'required']);
        $contact= new Contact($request->all());
        $contact->save();
        $contact->resources()->attach($request->input('resource_list'));
        //\Session::flash('flash_message', 'Contact Created Successfully!');

        return response()->json($contact);
    }

    public function edit(Contact $contact)
    {
        $resourceList = Resource::lists('name', 'id');
        return view('contacts.edit', compact('contact', 'resourceList'));
    }

    public function update(Contact $contact, ContactRequest $request)
    {
        //other validation is done in ContactRequest, this simply checks that the email is unique except this contact
        $this->validate($request,
            ['email' => 'unique:contacts,email,'.$contact->id]);
        $contact->update($request->all());
        if(!is_null($request->input('resource_list')))
        {
            $contact->resources()->sync($request->input('resource_list'));
        }
        else
        {
            $contact->resources()->sync([]);
        }
        \Session::flash('flash_message', 'Contact Updated Successfully!');
        return redirect('/contacts/' . $contact->id);
    }

    public function destroy(Contact $contact)
    {
        foreach($contact->flags as $flag)
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
        foreach($contact->resources as $resource)
        {
            DB::table('archive_contact_resource')->insert(
                [
                    'contact_id' => $contact->id,
                    'resource_id' => $resource->pivot->resource_id,
                    'created_at' => $resource->pivot->created_at,
                    'updated_at' => $resource->pivot->updated_at,
                    'archived_at' => Carbon::now()->format('Y-m-d H:i:s')
                ]
            );
        }
        DB::table('archive_contacts')->insert(
            ['id' => $contact->id,
                'firstName' => $contact->firstName,
                'lastName' => $contact->lastName,
                'email' => $contact->email,
                'phoneNumber' => $contact->phoneNumber,
                'created_at' => $contact->created_at,
                'updated_at' => $contact->updated_at,
                'archived_at' => Carbon::now()->format('Y-m-d H:i:s')]
        );
        $contact->delete();
        \Session::flash('flash_message', 'Contact Deleted');
        return redirect('/contacts');

    }

    /*
     * This method takes in a contact, compacts it into a "common flag format" and sends it to the flag.create view
     */
    public function flag(Contact $contact)
    {
        return view('flags.create')->with('url', 'contacts/flag/' . $contact->id)
            ->with('name', $contact->FullName);
    }

    public function storeFlag(Contact $contact, FlagRequest $request)
    {
        $flagData = ['level' => $request->level,
            'comments' => $request->comments,
            'resolved' => '0',
            'contact_id' => $contact->id,
            'submitted_by' => Auth::id()];
        $flag = new Flag($flagData);
        $flag->save();

        \Session::flash('flash_message', 'Flag Created Successfully!');

        return redirect('contacts/'. $contact->id);
    }
}
