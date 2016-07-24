@extends('layouts.dataTables')

@section('content')

<div class="container">
    @foreach($resources as $r)

        <h1 style="background-color: #d5d5d5">{{$r->Name}}</h1>
        </br>
        <p>{{$r->Comments}}</p>
        </br>
        <hr>
    @endforeach
</div>

@endsection