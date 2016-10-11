@extends('layouts.general')

@section('content')

        <a class="btn btn-small btn-primary pull-left" href="{{ URL::to('resources/emptyReport') }}" style="margin-bottom: 20px;">Empty Report</a>
        <a class="btn btn-small btn-primary pull-right" target="_blank" href="{{ URL::to('resources/generatePDF') }}" style="margin-bottom: 20px;">Print</a>

    @include('Resources._pdfLayoutNonprint')
@endsection