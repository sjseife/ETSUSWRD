@extends('layouts.general')

@section('content')

    <div class="container">
        <a class="btn btn-small btn-primary pull-left" href="{{ URL::to('worklist/emptyReport') }}" style="margin-bottom: 20px;">Empty Report</a>
        <a class="btn btn-small btn-primary pull-right" target="_blank" href="{{ URL::to('worklist/generatePDF') }}" style="margin-bottom: 20px;">Print</a>
    </div>
    @include('WorkList._pdfLayoutNonprint')
@endsection