<div class="form-group">
    {!! Form::label('name', 'Name:', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::text('name', null, ['class'=>'form-control input-md', 'required'=>'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('streetAddress', 'Street Address:', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::text('streetAddress', null, ['class'=>'form-control input-md', 'required'=>'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('streetAddress2', 'Street Address 2:', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::text('streetAddress2', null, ['class'=>'form-control input-md']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('city', 'City:', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::text('city', null, ['class'=>'form-control input-md', 'required'=>'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('county', 'County:', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::text('county', null, ['class'=>'form-control input-md', 'required'=>'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('state', 'State:', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::select('state',
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
                        null, ['class'=>'form-control input-md', 'required'=>'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('zipCode', 'Zip Code:', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::text('zipCode', null, ['class'=>'form-control input-md', 'required'=>'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('publicPhoneNumber', 'Phone Number:', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::tel('publicPhoneNumber', null, ['class'=>'form-control input-md']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('publicEmail', 'Email:', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::email('publicEmail', null, ['class'=>'form-control input-md']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('website', 'Website:', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::text('website', null, ['class'=>'form-control input-md']) !!}
    </div>
</div>
<div class="form-group">
    {!!  Form::label('operatingHours', 'Operating Hours:', ['class'=>'col-md-2 control-label']) !!}
    <div class= col-md-4>
        <div class="form-inline">
            <div class="form-group">
                {!! Form::label('monday', 'Monday:') !!}
                {!! Form::checkbox('mondayClosedCheck', 'mondayClosedCheck', true) !!} Closed
                {!! Form::time('mondayOpen', null, ['class'=>'form-control input-md', 'placeholder'=>'Open Time']) !!}
                {!! Form::time('mondayClose', null, ['class'=>'form-control input-md', 'placeholder'=>'Close Time']) !!}
            </div>
        </div>
        <div class="form-inline">
            <div class="form-group">
                {!! Form::label('tuesday', 'Tuesday:') !!}
                {!! Form::checkbox('tuesdayClosedCheck', 'tuesdayClosedCheck', true) !!} Closed
                {!! Form::time('tuesdayOpen', null, ['class'=>'form-control input-md', 'placeholder'=>'Open Time']) !!}
                {!! Form::time('tuesdayClose', null, ['class'=>'form-control input-md', 'placeholder'=>'Close Time']) !!}
            </div>
        </div>
        <div class="form-inline">
            <div class="form-group">
                {!! Form::label('wednesday', 'Wednesday:') !!}
                {!! Form::checkbox('wednesdayClosedCheck', 'wednesdayClosedCheck', true) !!} Closed
                {!! Form::time('wednesdayOpen', null, ['class'=>'form-control input-md', 'placeholder'=>'Open Time']) !!}
                {!! Form::time('wednesdayClose', null, ['class'=>'form-control input-md', 'placeholder'=>'Close Time']) !!}
            </div>
        </div>
        <div class="form-inline">
            <div class="form-group">
                {!! Form::label('thursday', 'Thursday:') !!}
                {!! Form::checkbox('thursdayClosedCheck', 'thursdayClosedCheck', true) !!} Closed
                {!! Form::time('thursdayOpen', null, ['class'=>'form-control input-md', 'placeholder'=>'Open Time']) !!}
                {!! Form::time('thursdayClose', null, ['class'=>'form-control input-md', 'placeholder'=>'Close Time']) !!}
            </div>
        </div>
        <div class="form-inline">
            <div class="form-group">
                {!! Form::label('friday', 'Friday:') !!}
                {!! Form::checkbox('fridayClosedCheck', 'fridayClosedCheck', true) !!} Closed
                {!! Form::time('fridayOpen', null, ['class'=>'form-control input-md', 'placeholder'=>'Open Time']) !!}
                {!! Form::time('fridayClose', null, ['class'=>'form-control input-md', 'placeholder'=>'Close Time']) !!}
            </div>
        </div>
        <div class="form-inline">
            <div class="form-group">
                {!! Form::label('saturday', 'Saturday:') !!}
                {!! Form::checkbox('saturdayClosedCheck', 'saturdayClosedCheck', true) !!} Closed
                {!! Form::time('saturdayOpen', null, ['class'=>'form-control input-md', 'placeholder'=>'Open Time']) !!}
                {!! Form::time('saturdayClose', null, ['class'=>'form-control input-md', 'placeholder'=>'Close Time']) !!}
            </div>
        </div>
        <div class="form-inline">
            <div class="form-group">
                {!! Form::label('sunday', 'Sunday:') !!}
                {!! Form::checkbox('sundayClosedCheck', 'sundayClosedCheck', true) !!} Closed
                {!! Form::time('sundayOpen', null, ['class'=>'form-control input-md', 'placeholder'=>'Open Time']) !!}
                {!! Form::time('sundayClose', null, ['class'=>'form-control input-md', 'placeholder'=>'Close Time']) !!}
            </div>
        </div>
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
    {!! Form::label('provider', 'Provider:', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::select('provider', $providerList, null, ['id'=>'provider', 'class'=>'form-control']) !!}
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
        {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary', 'name' => 'resource']) !!}
    </div>
</div>

<!-- Modal -->
{{--@include('Resources._createContactModal')--}}

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#category_list').select2({
                placeholder: 'Choose a Category',
                tags: true
            });
            $('#provider').select2({
                placeholder: 'Choose a Provider'
            });
        });
    </script>
@endpush