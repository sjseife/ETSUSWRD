@extends('layouts/general')

@section('content')
    <div class="container">
        <h1>Edit: {!! $category->name !!}</h1>
    </div>

    <hr/>

    {!! Form::model($category, [ 'method' => 'PATCH', 'class'=>'form-horizontal', 'url' => 'categories/' . $category->id]) !!}
        @include('categories._form', ['submitButtonText' => 'Update Category'])
    {!! Form::close() !!}

    {{--If user does not enter required field.--}}
    @include('errors.list')
@stop