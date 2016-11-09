<div class="form-group">
    {!! Form::label('firstName', 'First Name:', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::text('firstName', null, ['class'=>'form-control input-md']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('lastName', 'Last Name:', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::text('lastName', null, ['class'=>'form-control input-md']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('protectedEmail', 'Email Address:', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::text('protectedEmail', null, ['class'=>'form-control input-md']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('protectedPhoneNumber', 'Phone Number:', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::text('protectedPhoneNumber', null, ['class'=>'form-control input-md']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('resource_list', 'Resources:', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::select('resource_list[]', $resourceList, null, ['id' => 'resource_list', 'class' => 'form-control', 'multiple']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('event_list', 'Events:', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::select('event_list[]', $eventList, null, ['id' => 'event_list', 'class' => 'form-control', 'multiple']) !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-2"></div>
    <div class="col-md-4">
        {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}
        <a href="{{ '/contacts' }}" class="btn btn-danger"  style="margin-left:10%">Cancel</a>
    </div>
</div>
@push('scripts')
    <script>
        $('#resource_list').select2({
            placeholder: 'Choose a Resource',
        });
        $('#event_list').select2({
            placeholder: 'Choose an Event',
        });
    </script>
@endpush