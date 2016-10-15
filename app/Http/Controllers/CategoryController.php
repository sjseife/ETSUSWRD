<?php

namespace App\Http\Controllers;

use App\Category;
use App\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Resource;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        //Incrementing view when called
        app('App\Http\Controllers\ViewsController')->categoryView($category);

        return view('categories.show', compact('category'));
    }

    public function create()
    {
        $resourceList = Resource::lists('name', 'id');
        $eventList = Event::lists('name', 'id');
        return view('categories.create', compact('resourceList', 'eventList'));
    }

    public function store(Request $request)
    {
        $this->validate($request,
            ['name' => ['unique:categories,name','required']]);
        $categories = new Category($request->all());
        $categories->save();
        $categories->resources()->attach($request->input('resource_list'));
        $categories->events()->attach($request->input('event_list'));

        \Session::flash('flash_message', 'Categories Created Successfully!');

        return redirect('categories');
    }

    public function edit(Category $category)
    {
        $resourceList = Resource::lists('name', 'id');
        $eventList = Event::lists('name', 'id');
        return view('categories.edit', compact('category', 'resourceList', 'eventList'));
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
        if(!is_null($request->input('event_list')))
        {
            $category->events()->sync($request->input('event_list'));
        }
        else
        {
            $category->events()->sync([]);
        }
        \Session::flash('flash_message', 'Category Updated Successfully!');
        return redirect('/categories/' . $category->id);
    }
    
    public function destroy(Category $category)
    {
        foreach($category->resources as $resource)
        {
            DB::table('archive_category_resource')->insert(
                [
                    'category_id' => $category->id,
                    'resource_id' => $resource->pivot->resource_id,
                    'created_at' => $resource->pivot->created_at,
                    'updated_at' => $resource->pivot->updated_at,
                    'archived_at' => Carbon::now()->format('Y-m-d H:i:s')
                ]);
        }
        foreach($category->events as $event)
        {
            DB::table('archive_category_event')->insert(
                [
                    'category_id' => $category->id,
                    'event_id' => $event->pivot->event_id,
                    'created_at' => $event->pivot->created_at,
                    'updated_at' => $event->pivot->updated_at,
                    'archived_at' => Carbon::now()->format('Y-m-d H:i:s')
                ]);
        }
        DB::table('archive_categories')->insert(
            ['id' => $category->id,
                'name' => $category->name,
                'created_at' => $category->created_at,
                'updated_at' => $category->updated_at,
                'archived_at' => Carbon::now()->format('Y-m-d H:i:s')]
        );

        $category->delete();
        \Session::flash('flash_message', 'Category Deleted');
        return redirect('/categories');

    }
}
