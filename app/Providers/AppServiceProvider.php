<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Flag;
use App\Http\Requests\FlagRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer('layouts._NavBar', function($view) {
            $flagCount = Flag::where('resolved', '=', '0')->count();
            $view->with('flagCount', $flagCount);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
