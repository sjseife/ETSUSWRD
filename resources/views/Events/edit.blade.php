@extends('layouts/general')

@section('content')
    <div class="container">
        <h1>Edit: {!! $event->name !!}</h1>
    </div>

    <hr/>

    {!! Form::model($event, [ 'method' => 'PATCH', 'class'=>'form-horizontal', 'url' => 'events/' . $event->id]) !!}
    @include('events._form', ['submitButtonText' => 'Update Event'])
    {!! Form::close() !!}

    {{--If user does not enter required field.--}}
    @include('errors.list')
@stop