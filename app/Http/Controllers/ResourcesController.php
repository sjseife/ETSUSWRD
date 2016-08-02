<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ResourceRequest;
use App\Resource;
use App\Category;
use App\Contact;

class ResourcesController extends Controller
{
    public function index()
    {
        $resources = Resource::all();
        return view('resources.index', compact('resources'));
    }

    public function show(Resource $resource)
    {
        //$resource = Resource::findOrFail($id);
        return view('resources.show', compact('resource'));
    }

    public function create()
    {
        $categoryList = Category::lists('name', 'id');
        $passedContacts = $this->getAllContactsFullName();
        return view('resources.create', compact('categoryList', 'passedContacts'));
    }

    public function store(ResourceRequest $request)
    {
        $syncCategories = $this->checkForNewCategories($request->input('category_list'));
        $resource = new Resource($request->all());
        $resource->save();
        $resource->categories()->attach($syncCategories);
        $resource->contacts()->attach($request->input('contact_list'));

        \Session::flash('flash_message', 'Resource Created Successfully!');

        return redirect('resources');
    }

    public function edit(Resource $resource)
    {
        $categoryList = Category::lists('name', 'id');
        $passedContacts = $this->getAllContactsFullName();
        return view('resources.edit', compact('resource', 'categoryList', 'passedContacts'));
    }

    public function update(Resource $resource, ResourceRequest $request)
    {
        $syncCategories = $this->checkForNewCategories($request->input('category_list'));
        $resource->update($request->all());
        $resource->categories()->sync($syncCategories);
        $resource->contacts()->sync($request->input('contact_list'));
        \Session::flash('flash_message', 'Resource Updated Successfully!');
        return redirect('/resources/' . $resource->id);
    }
    
    public function destroy(Resource $resource)
    {
        $resource->delete();
        \Session::flash('flash_message', 'Resource Deleted');
        return redirect('/resources');

    }

    protected function checkForNewCategories(array $requestCategories)
    {
        //all categories, and requested categories
        $allCategories = Category::lists('id')->toArray();
        //seperated
        $newCategories = array_diff($requestCategories, $allCategories); //categories to be added to DB
        $syncCategories = array_diff($requestCategories, $newCategories); //categories already in DB

        foreach ($newCategories as $newCategory)
        {
            $newCategoryModel = Category::create(['name' => $newCategory]);
            $syncCategories[] = "".$newCategoryModel->id;
        }

        return $syncCategories;
    }

    public function getAllContactsFullName()
    {
        $allContacts = Contact::all();
        $passedContacts = array();
        foreach($allContacts as $contact)
        {
            $fullname = ucfirst($contact->firstName). ' ' . ucfirst($contact->lastName);
            $passedContacts[$contact->id] = $fullname;
        }

        return $passedContacts;
    }
}
