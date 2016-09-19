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
    {!! Form::label('email', 'Email Address:', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::text('email', null, ['class'=>'form-control input-md', 'id' => 'email']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('phoneNumber', 'Phone Number:', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::text('phoneNumber', null, ['class'=>'form-control input-md', 'id' => 'phoneNumber']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('resource_list', 'Resources:', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::select('resource_list[]', $resourceList, null, ['id' => 'resource_list', 'class' => 'form-control', 'multiple', 'input-md']) !!}
    </div>
</div>
@push('scripts')
<script>
    $('#resource_list').select2({
        placeholder: 'Choose a Resource',
    });
</script>
@endpush