@extends('layouts/general')

@section('content')
    <div class="container">
        <h1>Create Flag on {{ $name }}:</h1>
    </div>

    <hr/>

    {!! Form::open([ 'method' => 'POST', 'class'=>'form-horizontal', 'url' => $url]) !!}
    <div class="form-group">
        {!! Form::label('level', 'Level:', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-md-4">
            {!! Form::select('level', ['Admin'=>'Admin','GA'=>'GA','test'=>'Should Fail'], null, ['id' => 'resource_list', 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('comments', 'Description of Issue:', ['class'=>'col-md-2 control-label']) !!}
        <div class="col-md-4">
            {!! Form::textarea('comments', null, ['class'=>'form-control input-md']) !!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-2"></div>
        <div class="col-md-4">
            {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
    {!! Form::close() !!}

    {{--If input validation fails.--}}
    @include('errors.list')
@stop