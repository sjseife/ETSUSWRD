@extends('layouts/general')

@section('content')
    <div class="container">
        <div id="form-success"></div>
        <h1>Create a New Resource</h1>
    </div>

    <hr/>

    {!! Form::open(array('class'=>'form-horizontal', 'url' => 'resources', 'name' => 'resource')) !!}
        @include('resources._form', ['submitButtonText' => 'Create Resource'])
    {!! Form::close() !!}

    {{--If user does not enter required field.--}}
    @include('errors.list')

@stop