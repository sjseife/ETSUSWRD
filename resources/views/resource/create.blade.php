@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h1>Create a New Resource</h1>
    </div>

    <hr/>

    {!! Form::open(array('class'=>'form-horizontal', 'url' => 'resources')) !!}
    @include('resource._form', ['submitButtonText' => 'Create Resource'])
    {!! Form::close() !!}

    {{--If user does not enter required field.--}}
    @include('errors.list')


@stop