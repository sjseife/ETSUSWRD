@extends('layouts.general')

@section('content')

    @if($resourcesSet != false)
        <div class="container">
            <a class="btn btn-small btn-primary pull-left" href="{{ URL::to('resources/emptyReport') }}" style="margin-bottom: 20px;">Empty Report</a>
            <a class="btn btn-small btn-primary pull-right" target="_blank" href="{{ URL::to('resources/generatePDF') }}" style="margin-bottom: 20px;">Print</a>
        </div>
        <div class="container text-center">
            <object data="/report.pdf" type="application/pdf" width="80%" height="800">
            </object>
        </div>
    @else
        <div class="container">
            <h2>
                Report is empty!<br>
                Try adding resources to the report and come back...<br><br>
            </h2>
        </div>
    @endif
@endsection