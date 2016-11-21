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
use App\Event;
use Auth;
use Illuminate\Support\Facades\DB;

class ContactsController extends Controller
{
    public function index()
    {
        $contacts = Contact::where('archived','=','0')->get();
        return view('contacts.index', compact('contacts'));
    }

    public function show(Contact $contact)
    {
        return view('contacts.show', compact('contact'));
    }
    public function create()
    {
        $eventList = Event::lists('name', 'id');
        $resourceList = Resource::lists('name', 'id');
        return view('contacts.create', compact('eventList', 'resourceList'));
    }

    public function store(ContactRequest $request)
    {
        //other validation is done in ContactRequest, this simply checks that the email is unique
        $this->validate($request,
            ['email' => 'unique:contacts']);
        $contact= new Contact($request->all());
        $contact->save();
        $contact->events()->attach($request->input('event_list'));
        $contact->resources()->attach($request->input('resource_list'));

        flash($contact->full_name . ' created successfully!', 'success');

        return redirect('contacts');
    }

    /*
     * THIS function is not longer in operation, and should be combined with a single store function if it is needed again
     * Was updated for the provider change anyway. 10/10/2016 -William Kubenka
     * Was updated once again for the provider removal. 11/08/2016 -William Kubenka
     * Is back in operation! Actually I'm gonna delete and move it to an if statement in the regular store method. 11/21/2016 -William Kubenka
     *
     * Same as regular store, except it returns JSON. For some reason I would get tokenmismatch exceptions if I left
     * the data input as ContactRequest. As a result, data validation now happens entirely within the method.
     * This is planned to be used when creating a new resource so that the contact can be created from the same page using aJax
     */
    public function storeJSON(ContactRequest $request)
    {
        $this->validate($request,
            ['protectedEmail' => 'unique:contacts']);
        $contact= new Contact($request->all());
        $contact->save();
        $contact->events()->attach($request->input('event_list'));
        $contact->resources()->attach($request->input('resource_list'));

        return response()->json($contact);
    }

    public function edit(Contact $contact)
    {
        $eventList = Event::lists('name', 'id');
        $resourceList = Resource::lists('name', 'id');
        return view('contacts.edit', compact('contact', 'eventList', 'resourceList'));
    }

    public function update(Contact $contact, ContactRequest $request)
    {
        //other validation is done in ContactRequest, this simply checks that the email is unique except this contact
        $this->validate($request,
            ['email' => 'unique:contacts,email,'.$contact->id]);
        $contact->update($request->all());
        if(!is_null($request->input('event_list')))
        {
            $contact->events()->sync($request->input('event_list'));
        }
        else
        {
            $contact->events()->sync([]);
        }
        if(!is_null($request->input('resource_list')))
        {
            $contact->resources()->sync($request->input('resource_list'));
        }
        else
        {
            $contact->resources()->sync([]);
        }
        flash($contact->full_name . ' updated successfully!', 'success');
        return redirect('/contacts/' . $contact->id);
    }

    public function destroy(Contact $contact)
    {
        $contact->archived = '1';
        $contact->save();

        flash($contact->full_name . ' deleted.', 'success');
        return redirect('/contacts');

    }

    /*
     * This method takes in a contact, compacts it into a "common flag format" and sends it to the flag.create view
     */
    public function flag(Contact $contact)
    {
        $options = ['Unselected' => 'Please Select a Reason.',
            'Update'=>'Contact information incorrect.',
            'Delete'=>'Contact has been cancelled.'];
        return view('flags.create')->with('url', 'contacts/flag/' . $contact->id)
                                ->with('name', $contact->full_name)
                                ->with('options', $options);
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

       flash($contact->full_name . ' created successfully!', 'success');

        return redirect('contacts/'. $contact->id);
    }
}
