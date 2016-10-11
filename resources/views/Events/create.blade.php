@extends('layouts/general')

@section('content')
    <div class="container">
        <div id="form-success"></div>
        <h1>Create a New Event</h1>
    </div>

    <hr/>

    {!! Form::open(array('class'=>'form-horizontal', 'url' => 'events', 'name' => 'event')) !!}
    @include('events._form', ['submitButtonText' => 'Create Event'])
    {!! Form::close() !!}

    {{--If user does not enter required field.--}}
    @include('errors.list')
@stop