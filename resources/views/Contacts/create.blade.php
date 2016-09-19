@extends('layouts/general')

@section('content')
    <div class="container">
        <h1>Create a New Contact</h1>
    </div>

    <hr/>

    {!! Form::open(array('class'=>'form-horizontal', 'url' => 'contacts')) !!}
        @include('contacts._form', ['submitButtonText' => 'Create Contact'])
    {!! Form::close() !!}

    {{--If user does not enter required field.--}}
    @include('errors.list')


@stop