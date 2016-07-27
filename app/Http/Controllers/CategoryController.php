<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

use App\Http\Requests;

class CategoryController extends Controller
{
    public function view(Category $category)
    {
        return view('category.view', compact('category'));
    }
}
