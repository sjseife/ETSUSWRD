<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Resource;

use App\Http\Requests;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    public function create()
    {
        $resourceList = Resource::lists('name', 'id');
        return view('categories.create', compact('resourceList'));
    }

    public function store(Request $request)
    {
        $this->validate($request,
            ['name' => ['unique:categories,name','required']]);
        $categories = new Category($request->all());
        $categories->save();
        $categories->resources()->attach($request->input('resource_list'));

        \Session::flash('flash_message', 'Categories Created Successfully!');

        return redirect('categories');
    }

    public function edit(Category $category)
    {
        $resourceList = Resource::lists('name', 'id');
        return view('categories.edit', compact('category', 'resourceList'));
    }

    public function update(Category $category, Request $request)
    {
        $this->validate($request,
            ['name' => 'unique:categories,name,'.$category->id]);
        $category->update($request->all());
        if(!is_null($request->input('resource_list')))
        {
            $category->resources()->sync($request->input('resource_list'));
        }
        else
        {
            $category->resources()->sync([]);
        }
        \Session::flash('flash_message', 'Category Updated Successfully!');
        return redirect('/categories/' . $category->id);
    }
    
    public function destroy(Category $category)
    {
        $category->delete();
        \Session::flash('flash_message', 'Category Deleted');
        return redirect('/categories');

    }
}
