<?php

namespace App\Http\Controllers;

use App\Category;
use App\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Resource;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class ArchiveCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('archived','=','1')->get();
        return view('archive_categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        //$category = Category::findOrFail($id);
        //Incrementing view count when viewed
        //app('App\Http\Controllers\ViewsController')->categoryView($category);

        return view('archive_categories.show', compact('category'));
    }


    public function restore(Category $category, Request $request)
    {
        $category->archived = '0'; //set archived back to false
        $category->save();

        if($request->ajax())
        {
            return response()->json(); //it just needs any JSON response to indicate a success.
        }
        else
        {
            \Session::flash('flash_message', 'Category Added to Work List');
            return Redirect::back();
        }
    }

    public function removeReport(Category $category, Request $request)
    {
        Auth::user()->categories()->detach($category);
        if($request->ajax())
        {
            return response()->json(); //it just needs any JSON response to indicate a success.
        }
        else
        {
            \Session::flash('flash_message', $category->name.' removed from the Report.');
            return Redirect('/worklist/generateReport');
        }
    }

    public function showRestore(Category $category, Request $request)
    {
        $category->archived = '0'; //set archived back to false
        $category->save();

        flash($category->name . ' was restored to categories!', 'success');

        return redirect('/archive_categories');
    }

}
