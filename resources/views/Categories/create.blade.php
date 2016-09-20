@extends('layouts/general')

@section('content')
    <div class="container">
        <h1>Create a New Category</h1>
    </div>

    <hr/>

    {!! Form::open(array('class'=>'form-horizontal', 'url' => 'categories')) !!}
        @include('categories._form', ['submitButtonText' => 'Create Category'])
    {!! Form::close() !!}

    {{--If user does not enter required field.--}}
    @include('errors.list')


@stop