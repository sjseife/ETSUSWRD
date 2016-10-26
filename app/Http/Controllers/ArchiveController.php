<?php
/**
 * Created by PhpStorm.
 * User: Stan
 * Date: 10/25/2016
 * Time: 12:58 PM
 */

namespace App\Http\Controllers;

use App\Flag;
use App\DailyHours;
use App\Provider;
use App\Http\Requests\FlagRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ResourceRequest;
use App\Resource;
use App\Category;
use App\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;

class ArchiveController extends Controller
{
    public function index()
    {
        return view('archive.index');
    }
}