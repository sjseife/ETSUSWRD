@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h1>Edit: {{ $resource->Name }}</h1>
    </div>

    <hr/>

    <form class="form-horizontal" method="POST" action="/resources/{{$resource->Id}}">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}
        <?php echo Form::model($resource); ?>
        @include('resource._form', ['submitButtonText' => 'Update Resource'])
    </form>



    <!-- incase user does not enter required field.-->
    @include('errors.list')
@stop