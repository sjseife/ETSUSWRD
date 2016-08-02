@extends('layouts.dashboard')

@section('content')

    <div class="container">
        <a class="btn btn-small btn-primary pull-right" target="_blank" href="{{ URL::to('resource/generatePDF') }}" style="margin-bottom: 20px;">Print</a>
    </div>
    @include('resource.pdfLayout');
@endsection