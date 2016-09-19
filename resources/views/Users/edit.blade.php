@extends('layouts/general')

@section('content')
    <div class="container">
        <h1>Edit: {!! $user->name !!}</h1>
    </div>

    <hr/>

    {!! Form::model($user, [ 'method' => 'PATCH', 'class'=>'form-horizontal', 'url' => 'users/' . $user->id]) !!}
    @include('users._form', ['submitButtonText' => 'Update User'])
    {!! Form::close() !!}

    {{--If input validation fails.--}}
    @include('errors.list')
@stop