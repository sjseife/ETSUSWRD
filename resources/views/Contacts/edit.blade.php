@extends('layouts/general')

@section('content')
    <div class="container">
        <h1>Edit: {!! $contact->Name !!}</h1>
    </div>

    <hr/>

    {!! Form::model($contact, [ 'method' => 'PATCH', 'class'=>'form-horizontal', 'url' => 'contacts/' . $contact->id]) !!}
        @include('contacts._form', ['submitButtonText' => 'Update Contact'])
    {!! Form::close() !!}

    {{--If input validation fails.--}}
    @include('errors.list')
@stop