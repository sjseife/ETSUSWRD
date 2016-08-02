<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ContactRequest;
use App\Contact;
use App\Resource;

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
        $this->validate($request,
            ['email' => 'unique:contacts,email']);
        $contact= new Contact($request->all());
        $contact->save();
        $contact->resources()->attach($request->input('resource_list'));

        \Session::flash('flash_message', 'Contact Created Successfully!');

        return redirect('contacts');
    }

    public function edit(Contact $contact)
    {
        $resourceList = Resource::lists('name', 'id');
        return view('contacts.edit', compact('contact', 'resourceList'));
    }

    public function update(Contact $contact, ContactRequest $request)
    {
        $this->validate($request,
            ['email' => 'unique:contacts,email,'.$contact->id]);
        $contact->update($request->all());
        $contact->resources()->sync($request->input('resource_list'));
        \Session::flash('flash_message', 'Contact Updated Successfully!');
        return redirect('/contacts/' . $contact->id);
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        \Session::flash('flash_message', 'Contact Deleted');
        return redirect('/contact');

    }
}
