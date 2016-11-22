<div class="form-group">
    {!! Form::label('name', 'Name:', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::text('name', null, ['class'=>'form-control input-md']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('email', 'Email Address:', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::email('email', null, ['class'=>'form-control input-md']) !!}
    </div>
</div>
<div class="form-group hidden">
    {!! Form::label('password', 'Password:', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::password('password', ['class'=>'form-control input-md']) !!}
    </div>
</div>
<div class="form-group hidden">
    {!! Form::label('password_confirmation', 'Confirm Password:', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::password('password_confirmation', ['class'=>'form-control input-md']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('role', 'Role:', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::select('role_id', $roles, null, ['id' => 'role_id', 'class' => 'form-control', 'multiple']) !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-2"></div>
    <div class="col-md-4">
        {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}
        <a href="{{ url('/users') }}" class="btn btn-danger"  style="margin-left:10%">Cancel</a>

    </div>
</div>