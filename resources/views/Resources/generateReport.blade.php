@extends('layouts.general')

@section('content')

    <div class="container">
        <a class="btn btn-small btn-primary pull-right" target="_blank" href="{{ URL::to('resources/generatePDF') }}" style="margin-bottom: 20px;">Print</a>
    </div>
    @include('resources.pdfLayoutNonprint')
@endsection