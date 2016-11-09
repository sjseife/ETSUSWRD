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
    <div class="col-md-4 centered-div"><br><br>
        @if(isset($resource))
            @foreach($resource->hours as $hour)
                <div class="form-inline hours">
                    <div class="form-group">
                        {!! Form::text('day[]', $hour->day, ['class'=>'form-control input-md']) !!}<br />
                        {!! Form::time('open[]', $hour->openTime, ['class'=>'form-control input-md', 'placeholder'=>'Open Time']) !!} -
                        {!! Form::time('close[]', $hour->closeTime, ['class'=>'form-control input-md', 'placeholder'=>'Close Time']) !!}
                        <button type=button class="btn btn-link btn-small removeHours">Remove</button>
                    </div>
                </div>
            @endforeach
        @endif
        <button type=button class="btn btn-link btn-small" id="newHours">Add More Hours</button>
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
    {!! Form::label('category_list', 'Categories:', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::select('category_list[]', $categoryList, null, ['id' => 'category_list', 'class' => 'form-control', 'multiple']) !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-2"></div>
    <div class="col-md-4">
        {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary', 'name' => 'resource']) !!}
        <a href="{{ '/resources' }}" class="btn btn-danger"  style="margin-left:10%">Cancel</a>

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
            $('#contact_list').select2({
                placeholder: 'Choose a Contact'
            });



        });

        $( "#newHours" ).click(function() {
            var new_add = '<div class="form-inline hours">' +
                    '<div class="form-group">' +
                    '<input class="form-control input-md" name="day[]" type="text" placeholder="Day(s)"><br />' +
                    '<input class="form-control input-md" placeholder="Open Time" name="open[]" type="time"> -' +
                    '<input class="form-control input-md" placeholder="Close Time" name="close[]" type="time">' +
                    '<button type=button class="btn btn-link btn-small addedRemoveHours">Remove</button>' +
                    '</div>' +
                    '</div>';
            $(this).before(new_add);
            $( ".addedRemoveHours" ).click(function() {
                $(this).closest('.hours').remove();
            });
        });

        $( ".removeHours" ).click(function() {
            $(this).closest('.hours').remove();
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