<?php

namespace App\Http\Controllers;

use App\Category;
use App\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use phpDocumentor\Reflection\Types\Array_;
use  Illuminate\Support\Collection;

class ViewsController extends Controller
{


    public function categoryView(Category $id)
    {
        if (file_exists("C:\Users\Richard\PhpstormProjects\swrd-team2b\app\Http\Controllers\countlogcategory")) {
            $counterfile = fopen("C:\Users\Richard\PhpstormProjects\swrd-team2b\app\Http\Controllers\countlogcategory", "r");
            $count = fgets($counterfile, 1000);
            fclose($counterfile);
            $count = $count + 1;

// opens countlogcategory.txt to change new hit number
            $counterfile = fopen("C:\Users\Richard\PhpstormProjects\swrd-team2b\app\Http\Controllers\countlogcategory", "w");
            fwrite($counterfile, $count);
            //fwrite($counterfile, " views");


            fclose($counterfile);
        }
        else{

        }
        // return view('views', compact('count'));


    }

    //Dynamic attempt
    public function resourceView(Resource $resource)
    {
        $count = 0;
        $id = 0;

        $resource=collect([
            ['id' => $id, 'count'=> $count],
            ['id' => 2, 'count' => $count],
            ['id' => 3, 'count' => $count],

        ]);


        if (\Request::is('resources/1')) {

            $count++;
            $id++;

            // $resources = $resource->combine([$id,$count]);

            //$resources->all();
            // echo $resources;

            //$counterfile = "C:\Users\Richard\PhpstormProjects\swrd-team2\app\Http\Controllers\countlogresource.txt";
            //$count1 = file_get_contents($counterfile);


            //fclose($counterfile);
            //$count1= $count1 +1;

            // opens countlogcategory.txt to change new hit number
            //$counterfile = fopen("C:\Users\Richard\PhpstormProjects\swrd-team2\app\Http\Controllers\countlogresource.txt","w");
            //fwrite($counterfile, $count1);
            //fwrite($counterfile, " views : Resource 1");
            //fwrite($counterfile, " views");


            //fclose($counterfile);
        }

        if (\Request::is('resources/2')) {


        }


        // return view('views', compact('count'));


    }


}
