<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

use App\Http\Requests;

class CategoryController extends Controller
{
    public function view(Category $category)
    {
        foreach($category->resources() as $res)
        {
            var_dump($res);
        }
        return view('category.view', compact('category'));
    }
}
