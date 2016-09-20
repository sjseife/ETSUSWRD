@extends('layouts/general')

@section('content')
    <div class="container">
        <h1>Edit Flag:</h1>
    </div>

    <hr/>

    {!! Form::model($flag, [ 'method' => 'PATCH', 'class'=>'form-horizontal', 'url' => 'flags/' . $flag->id]) !!}
        <div class="form-group">
            {!! Form::label('level', 'Level:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-md-4">
                {!! Form::select('level', ['Admin'=>'Admin','GA'=>'GA','test'=>'Should Fail'], $flag->level, ['id' => 'resource_list', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('comments', 'Description of Issue:', ['class'=>'col-md-2 control-label']) !!}
            <div class="col-md-4">
                {!! Form::textarea('comments', $flag->comments, ['class'=>'form-control input-md']) !!}
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-2"></div>
            <div class="col-md-4">
                {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
    {!! Form::close() !!}

    {{--If input validation fails.--}}
    @include('errors.list')
@stop