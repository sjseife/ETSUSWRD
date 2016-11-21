<div class="form-group">
    {!! Form::label('firstName', 'First Name:', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::text('firstName', null, ['class'=>'form-control input-md', 'id' => 'firstName']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('lastName', 'Last Name:', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::text('lastName', null, ['class'=>'form-control input-md', 'id' => 'lastName']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('protectedEmail', 'Email Address:', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::text('protectedEmail', null, ['class'=>'form-control input-md', 'id' => 'email']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('protectPhoneNumber', 'Phone Number:', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::text('protectedPhoneNumber', null, ['class'=>'form-control input-md', 'id' => 'phoneNumber']) !!}
    </div>
</div>