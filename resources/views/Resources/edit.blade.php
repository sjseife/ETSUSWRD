@extends('layouts/general')

@section('content')
    <div class="container">
        <h1>Edit: {!! $resource->name !!}</h1>
    </div>

    <hr/>

    {!! Form::model($resource, [ 'method' => 'PATCH', 'class'=>'form-horizontal', 'url' => 'resources/' . $resource->id]) !!}
        @include('resources._form', ['submitButtonText' => 'Update Resource'])
    {!! Form::close() !!}

    {{--If user does not enter required field.--}}
    @include('errors.list')
@stop