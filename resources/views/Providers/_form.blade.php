<div class="form-group">
    {!! Form::label('name', 'Name:', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::text('name', null, ['class'=>'form-control input-md']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('publicPhoneNumber', 'Phone Number:', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::text('publicPhoneNumber', null, ['class'=>'form-control input-md']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('publicEmail', 'Email Address:', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::text('publicEmail', null, ['class'=>'form-control input-md']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('website', 'Website:', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::text('website', null, ['class'=>'form-control input-md']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('description', 'Description:', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::textarea('description', null, ['class'=>'form-control input-md']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('comments', 'Comments:', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::textarea('comments', null, ['class'=>'form-control input-md']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('contact_list', 'Contacts:', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::select('contact_list[]', $contactList, null, ['id' => 'contact_list', 'class' => 'form-control', 'multiple']) !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-2"></div>
    <div class="col-md-4">
        {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}
    </div>
</div>
@push('scripts')
<script>
    $('#contact_list').select2({
        placeholder: 'Choose a Contact',
    });
</script>
@endpush