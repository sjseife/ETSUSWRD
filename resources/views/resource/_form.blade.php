<div class="form-group">
    {!! Form::label('Name', 'Name:', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::text('Name', null, ['class'=>'form-control input-md']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('StreetAddress', 'Street Address:', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::text('StreetAddress', null, ['class'=>'form-control input-md']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('StreetAddress2', 'Street Address 2:', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::text('StreetAddress2', null, ['class'=>'form-control input-md']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('City', 'City:', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::text('City', null, ['class'=>'form-control input-md']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('County', 'County:', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::text('County', null, ['class'=>'form-control input-md']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('State', 'State:', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::select('State',
                        ['AL' => 'Alabama', 'AK' => 'Alaska', 'AZ' => 'Arizona', 'AR' => 'Arkansas',
                        'CA' => 'California', 'CO' => 'Colorado', 'CT' => 'Connecticut', 'DE' => 'Delaware',
                        'DC' => 'District of Columbia', 'FL' => 'Florida', 'GA' => 'Georgia', 'HI' => 'Hawaii',
                        'ID' => 'Idah', 'IL' => 'Illinois', 'IN' => 'Indiana', 'IA' => 'Iowa', 'KS' => 'Kansas',
                        'KY' => 'Kentucky', 'LA' => 'Louisiana', 'ME' => 'Maine', 'MD' => 'Maryland',
                        'MA' => 'Massachusetts', 'MI' => 'Michigan', 'MN' => 'Minnisota', 'MS' => 'Mississippi',
                        'MO' => 'Missouri', 'MT' => 'Montana', 'NE' => 'Nebraska', 'NV' => 'Nevada',
                        'NH' => 'New Hampshire', 'NJ' => 'New Jersey', 'NM' => 'New Mexico', 'NY' => 'New York',
                        'NC' => 'North Carolina', 'ND' => 'North Dakota', 'OH' => 'Ohio', 'OK' => 'Oklahoma',
                        'OR' => 'Oregon', 'PA' => 'Pennsylvania', 'RI' => 'Rhode Island', 'SC'=> 'South Carolina',
                        'SD' => 'South Dakota', 'TN' => 'Tennessee', 'TX' => 'Texas', 'UT' => 'Utah',
                        'VT' => 'Vermont', 'VA' => 'Virginia', 'WA' => 'Washington', 'WV' => 'West Virginia',
                        'WI' => 'Wisconsin', 'WY' => 'Wyoming'],
                        null, ['class'=>'form-control input-md']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('Zipcode', 'Zip Code:', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::text('Zipcode', null, ['class'=>'form-control input-md']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('PhoneNumber', 'Phone Number:', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::tel('PhoneNumber', null, ['class'=>'form-control input-md']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('OpeningHours', 'Opening Hours:', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::time('OpeningHours', null, ['class'=>'form-control input-md']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('ClosingHours', 'Closing Hours:', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::time('ClosingHours', null, ['class'=>'form-control input-md']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('Comments', 'Comments:', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::textarea('Comments', null, ['class'=>'form-control input-md']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('category_list', 'Categories:', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::select('category_list[]', $categoryList, null, ['id' => 'category_list', 'class' => 'form-control', 'multiple']) !!}
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
    $('#category_list').select2({
        placeholder: 'Choose a Category',
        tags: true
    });
</script>
@endpush