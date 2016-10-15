@extends('layouts/general')

@section('content')
    <div class="container">
        <h1>Create a New Provider</h1>
    </div>

    <hr/>

    {!! Form::open(array('class'=>'form-horizontal', 'url' => 'providers')) !!}
    @include('providers._form', ['submitButtonText' => 'Create Provider'])
    {!! Form::close() !!}

    {{--If user does not enter required field.--}}
    @include('errors.list')


@stop