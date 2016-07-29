<?php
/**
 * Created by PhpStorm.
 * User: Zac
 * Date: 7/26/2016
 * Time: 3:45 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use App\Resource;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return view('contact.index', compact('contacts'));
    }

    public function viewForResource($id)
    {
        $contactsAll = Contact::all();
        $contacts = null;
        foreach ($contactsAll as $con) {
            if ($con->resourceId == $id)
            {
                $contacts += $con;
            }
        }
        return view('contact.index', compact('contacts'));
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

        return redirect('/home');
    }
}