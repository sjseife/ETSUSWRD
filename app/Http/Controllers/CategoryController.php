<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

use App\Http\Requests;

class CategoryController extends Controller
{
    public function view(Category $category)
    {
        return view('Category.view', compact('category'));
    }
    
    public function create()
    {
        return view('Category.create');
    }
    
    public function store()
    {
        $category = new Category(request()->all());
        $category->save();

        return redirect('/home');
    }
    
    public function edit(Category $category)
    {
        return view('Category.edit', compact('category'));
    }
    
    public function update(Request $request, Category $category)
    {
        unset($request['_method']);
        unset($request['_token']);
        Category::where('Id', $category->Id)
            ->update($request->all());
        return back();
    }
    
    public function index()
    {
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }
}
