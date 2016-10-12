<style>
    .hidden{
        display:none;
    }
    .centered-div{
        margin: 0 auto;
    }
</style>

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
    <div class="col-md-3 centered-div"><br><br>
        <div class="form-inline">
            <div class="form-group">
                {!! Form::label('monday', 'Monday:') !!}<br>
                {!! Form::checkbox('mondayClosedCheck', 'mondayClosedCheck', true, ['id' => 'mondayClosedCheck', 'class' => 'ClosedCheck', 'onClick' => "Close(0);"]) !!} Closed
                {!! Form::checkbox('mondaySame', 'mondaySame', false, ['id' => 'mondaySame', 'class' => 'Same hidden', 'onClick' => "SameAsAbove(0);"]) !!} <br>
                {!! Form::time('mondayOpen', null, ['class'=>'form-control input-md OpenTime', 'placeholder'=>'Open Time','id' => 'mondayOpen', 'onChange' => "Uncheck(0);"]) !!}
                {!! Form::time('mondayClose', null, ['class'=>'form-control input-md CloseTime', 'placeholder'=>'Close Time','id' => 'mondayClose', 'onChange' => "Uncheck(0);"]) !!}
            </div>
        </div><br>
        <div class="form-inline">
            <div class="form-group">
                {!! Form::label('tuesday', 'Tuesday:') !!}<br>
                {!! Form::checkbox('tuesdayClosedCheck', 'tuesdayClosedCheck', true, ['id' => 'tuesdayClosedCheck', 'class' => 'ClosedCheck', 'onClick' => "Close(1);"]) !!} Closed
                {!! Form::checkbox('tuesdaySame', 'tuesdaySame', false, ['id' => 'tuesdaySame', 'class' => 'Same', 'onClick' => "SameAsAbove(1);"]) !!} Same as Above 
                {!! Form::time('tuesdayOpen', null, ['class'=>'form-control input-md OpenTime', 'placeholder'=>'Open Time','id' => 'tuesdayOpen', 'onChange' => "Uncheck(1);"]) !!}
                {!! Form::time('tuesdayClose', null, ['class'=>'form-control input-md CloseTime', 'placeholder'=>'Close Time','id' => 'tuesdayClose', 'onChange' => "Uncheck(1);"]) !!}
            </div>
        </div><br>
        <div class="form-inline">
            <div class="form-group">
                {!! Form::label('wednesday', 'Wednesday:') !!}<br>
                {!! Form::checkbox('wednesdayClosedCheck', 'wednesdayClosedCheck', true, ['id' => 'wednesdayClosedCheck', 'class' => 'ClosedCheck', 'onClick' => "Close(2);"]) !!} Closed
                {!! Form::checkbox('wednesdaySame', 'wednesdaySame', false, ['id' => 'wednesdaySame', 'class' => 'Same', 'onClick' => "SameAsAbove(2);"]) !!} Same as Above
                {!! Form::time('wednesdayOpen', null, ['class'=>'form-control input-md OpenTime', 'placeholder'=>'Open Time','id' => 'wednesdayOpen', 'onChange' => "Uncheck(2);"]) !!}
                {!! Form::time('wednesdayClose', null, ['class'=>'form-control input-md CloseTime', 'placeholder'=>'Close Time','id' => 'wednesdayClose', 'onChange' => "Uncheck(2);"]) !!}
            </div>
        </div><br>
        <div class="form-inline">
            <div class="form-group">
                {!! Form::label('thursday', 'Thursday:') !!}<br>
                {!! Form::checkbox('thursdayClosedCheck', 'thursdayClosedCheck', true, ['id' => 'thursdayClosedCheck', 'class' => 'ClosedCheck', 'onClick' => "Close(3);"]) !!} Closed
                {!! Form::checkbox('thursdaySame', 'thursdaySame', false, ['id' => 'thursdaySame', 'class' => 'Same', 'onClick' => "SameAsAbove(3);"]) !!} Same as Above
                {!! Form::time('thursdayOpen', null, ['class'=>'form-control input-md OpenTime', 'placeholder'=>'Open Time','id' => 'thursdayOpen', 'onChange' => "Uncheck(3);"]) !!}
                {!! Form::time('thursdayClose', null, ['class'=>'form-control input-md CloseTime', 'placeholder'=>'Close Time','id' => 'thursdayClose', 'onChange' => "Uncheck(3);"]) !!}
            </div>
        </div><br>
        <div class="form-inline">
            <div class="form-group">
                {!! Form::label('friday', 'Friday:') !!}<br>
                {!! Form::checkbox('fridayClosedCheck', 'fridayClosedCheck', true, ['id' => 'fridayClosedCheck', 'class' => 'ClosedCheck', 'onClick' => "Close(4);"]) !!} Closed
                {!! Form::checkbox('fridaySame', 'fridaySame', false, ['id' => 'fridaySame', 'class' => 'Same', 'onClick' => "SameAsAbove(4);"]) !!} Same as Above
                {!! Form::time('fridayOpen', null, ['class'=>'form-control input-md OpenTime', 'placeholder'=>'Open Time','id' => 'fridayOpen', 'onChange' => "Uncheck(4);"]) !!}
                {!! Form::time('fridayClose', null, ['class'=>'form-control input-md CloseTime', 'placeholder'=>'Close Time','id' => 'fridayClose', 'onChange' => "Uncheck(4);"]) !!}
            </div>
        </div><br>
        <div class="form-inline">
            <div class="form-group">
                {!! Form::label('saturday', 'Saturday:') !!}<br>
                {!! Form::checkbox('saturdayClosedCheck', 'saturdayClosedCheck', true, ['id' => 'saturdayClosedCheck', 'class' => 'ClosedCheck', 'onClick' => "Close(5);"]) !!} Closed
                {!! Form::checkbox('saturdaySame', 'saturdaySame', false, ['id' => 'saturdaySame', 'class' => 'Same', 'onClick' => "SameAsAbove(5);"]) !!} Same as Above 
                {!! Form::time('saturdayOpen', null, ['class'=>'form-control input-md OpenTime', 'placeholder'=>'Open Time','id' => 'saturdayOpen', 'onChange' => "Uncheck(5);"]) !!}
                {!! Form::time('saturdayClose', null, ['class'=>'form-control input-md CloseTime', 'placeholder'=>'Close Time','id' => 'saturdayClose', 'onChange' => "Uncheck(5);"]) !!}
            </div>
        </div><br>
        <div class="form-inline">
            <div class="form-group">
                {!! Form::label('sunday', 'Sunday:') !!}<br>
                {!! Form::checkbox('sundayClosedCheck', 'sundayClosedCheck', true, ['id' => 'sundayClosedCheck', 'class' => 'ClosedCheck', 'onClick' => "Close(6);"]) !!} Closed
                {!! Form::checkbox('sundaySame', 'sundaySame', false, ['id' => 'sundaySame', 'class' => 'Same', 'onClick' => "SameAsAbove(6);"])  !!} Same as Above 
                {!! Form::time('sundayOpen', null, ['class'=>'form-control input-md OpenTime', 'placeholder'=>'Open Time', 'id' => 'sundayOpen', 'onChange' => "Uncheck(6);"]) !!}
                {!! Form::time('sundayClose', null, ['class'=>'form-control input-md CloseTime', 'placeholder'=>'Close Time','id' => 'sundayClose', 'onChange' => "Uncheck(6);"]) !!}
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

        function checkRefresh(value)
        {
            document.submit();
        }
        function SameAsAbove(i){
            var OpenTime = document.getElementsByClassName('OpenTime');
            var CloseTime = document.getElementsByClassName('CloseTime');

            var ClosedCheck = document.getElementsByClassName('ClosedCheck');
            var Same =  document.getElementsByClassName('Same');

            if(Same[i].checked){
                ClosedCheck[i].checked = false;
                OpenTime[i].value = OpenTime[i-1].value;
                CloseTime[i].value = CloseTime[i-1].value;

                checkRefresh();
            }

        }

        function Close(i) {

            var OpenTime = document.getElementsByClassName('OpenTime');
            var CloseTime = document.getElementsByClassName('CloseTime');

            var ClosedCheck = document.getElementsByClassName('ClosedCheck');
            var Same = document.getElementsByClassName('Same');

            if (ClosedCheck[i].checked) {
                Same[i].checked = false;
                OpenTime[i].value = '';
                CloseTime[i].value = '';

                checkRefresh();
            }
        }

            function Uncheck(i){

                var ClosedCheck = document.getElementsByClassName('ClosedCheck');

                if(ClosedCheck[i].checked){
                    ClosedCheck[i].checked = false;

                    checkRefresh();
                }

        }

    </script>
@endpush