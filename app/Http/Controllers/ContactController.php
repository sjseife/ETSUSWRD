<?php
/**
 * Created by PhpStorm.
 * User: Zac
 * Date: 7/26/2016
 * Time: 3:45 PM
 */

namespace App\Http\Controllers;

use App\Contact;
use App\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return view('contact.index', compact('contacts'));
    }

    public function view(Contact $id)
    {
        $resource = Resource::all();
        return view('contact.view', compact('id', 'resource'));
    }

    public function create()
    {
        $resource = Resource::all();
        return view('contact.create',compact('resource'));
    }
    
    public function createContact()
    {
        $category = new Contact(request()->all());
        $category->save();

        return redirect('/contact');
    }
}