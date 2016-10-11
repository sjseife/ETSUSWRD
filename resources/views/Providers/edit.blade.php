@extends('layouts/general')

@section('content')
    <div class="container">
        <h1>Edit: {!! $provider->name !!}</h1>
    </div>

    <hr/>

    {!! Form::model($provider, [ 'method' => 'PATCH', 'class'=>'form-horizontal', 'url' => 'providers/' . $provider->id]) !!}
    @include('providers._form', ['submitButtonText' => 'Update Provider'])
    {!! Form::close() !!}

    {{--If input validation fails.--}}
    @include('errors.list')
@stop