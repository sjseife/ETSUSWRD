@extends('layouts/general')

@section('content')
    <div class="container">
        <h1>Create a New User</h1>
    </div>

    <hr/>

    {!! Form::open(array('class'=>'form-horizontal', 'url' => 'users')) !!}
    @include('users._form', ['submitButtonText' => 'Create User'])
    {!! Form::close() !!}

    {{--If user does not enter required field.--}}
    @include('errors.list')


@stop