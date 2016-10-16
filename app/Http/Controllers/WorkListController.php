<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class WorkListController extends Controller
{
    public function generateReport()
    {
        $resources = Auth::user()->resources;
        $events = Auth::user()->events;

        if($resources->isEmpty() && $events->isEmpty()){
            $resourcesSet = false;
            return view('WorkList.generateReport', compact('resources', 'events', 'resourcesSet'));
        }
        else{
            $resourcesSet = true;
            $pdf = App::make('dompdf.wrapper');
            $view = View::make('WorkList._pdfLayout')->with('resources', $resources)->with('events', $events);
            $contents = $view->render();
            $pdf->loadHTML($contents);
            $report = $pdf->output();
            file_put_contents('report.pdf', $report);
            return view('WorkList.generateReport', compact('resources', 'events', 'report', 'resourcesSet'));
        }
    }

    public function mobileReport()
    {
        $resources = Auth::user()->resources;
        $events = Auth::user()->events;
        $pdf = App::make('dompdf.wrapper');
        $view = View::make('WorkList._pdfLayout')->with('resources', $resources)->with('events', $events);
        $contents = $view->render();
        $pdf->loadHTML($contents);
        $report = $pdf->output();
        file_put_contents('report.pdf', $report);
        return Redirect('/report.pdf');
    }

    public function emptyReport()
    {
        Auth::user()->resources()->detach();
        Auth::user()->events()->detach();
        return Redirect::back();
    }

    public function generatePDF()
    {
        $pdf = App::make('dompdf.wrapper');
        $view = View::make('WorkList._pdfLayout')->with('resources', Auth::user()->resources)->with('events', Auth::user()->events);
        $contents = $view->render();
        $pdf->loadHTML($contents);
        return $pdf->stream();
    }
}
