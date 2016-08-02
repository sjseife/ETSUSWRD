@extends('layouts/dashboard')

@section('content')
    <div class="container">
        <h1>Edit: {!! $resource->Name !!}</h1>
    </div>

    <hr/>

    {!! Form::model($resource, [ 'method' => 'PATCH', 'class'=>'form-horizontal', 'url' => 'resources/' . $resource->id]) !!}
    @include('resource._form', ['submitButtonText' => 'Update Resource'])
    {!! Form::close() !!}

    <!-- incase user does not enter required field.-->
    @include('errors.list')
@stop