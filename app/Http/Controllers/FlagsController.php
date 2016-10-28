<?php

namespace App\Http\Controllers;

use App\Flag;
use App\Http\Requests\FlagRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class FlagsController extends Controller
{
    public function index()
    {
        $flags = Flag::where('resolved','=','0')->get();

        return view('flags.index', compact('flags'));
    }

    public function show(Flag $flag)
    {
        return view('flags.show', compact('flag'));
    }

    public function edit(Flag $flag)
    {
        return view('flags.edit', compact('flag'));
    }

    public function update(Flag $flag, FlagRequest $request)
    {
        $flag->update($request->all());
        \Session::flash('flash_message', 'Flag Updated Successfully!');
        return redirect('/flags/' . $flag->id);
    }

    public function destroy(Flag $flag)
    {
        $flag->archived = '1';
        $flag->save();

        \Session::flash('flash_message', 'Flag Deleted');
        return redirect('/flags');
    }

    public function resolve(Flag $flag)
    {
        $flag->update(['resolved' => '1']);
        \Session::flash('flask_message', 'Flag Resolved');
        return redirect('flags');
    }
}
