<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Resource;
use App\Http\Requests;

class CategoryController extends Controller
{
    public function view(Category $id)
    {
        return view('Category.view', compact('id'));
    }
    
    public function create()
    {
        return view('Category.create');
    }
    
    public function store()
    {
        $category = new Category(request()->all());
        $category->save();

        return redirect('/category');
    }
    
    public function edit(Category $id)
    {
        return view('Category.edit', compact('id'));
    }
    
    public function update(Request $request, Category $id)
    {
        unset($request['_method']);
        unset($request['_token']);
        Category::where('id', $id->id)
            ->update($request->all());
        return redirect('category');
    }
    
    public function index()
    {
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }
}
