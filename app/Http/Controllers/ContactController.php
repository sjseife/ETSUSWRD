<?php
/**
 * Created by PhpStorm.
 * User: Zac
 * Date: 7/26/2016
 * Time: 3:45 PM
 */

namespace App\Http\Controllers;


class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();

        // load the view and pass the contacts
        return view('contact.index')
            ->with('contacts', $contacts);
    }

    public function create()
    {
        return view('contact.create');
    }
    
    public function createContact()
    {
        $contact = new Contact(request()->all());
        $contact->save();
        return redirect('/home');
    }
}