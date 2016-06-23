<?php
/**
 * Created by PhpStorm.
 * User: Ryan
 * Date: 6/20/2016
 * Time: 9:35 PM
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Resource;

class ResourceController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    public function create()
    {
        return view('resource.create');
    }

    public function createResource()
    {
        $resource = new Resource(request()->all());
        $resource->save();
        return redirect('/home');
    }
}