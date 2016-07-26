@extends('layouts.app')


@section('content')

    <div class="content">
        <div class="col-md-11 text-center">
            <a href="/resource" class="btn btn-link" type="link">Back to Resources</a>
        </div>
        <form class="form-horizontal" method="POST" action="/resource/{{$id->Id}}">
            {{ method_field('PATCH') }}
            {{ csrf_field() }}
            <div class="form-group">
                <label class="col-md-2 control-label" for="Name">Name</label>
                <div class="col-md-4">
                    <input id="Name" name="Name" type="text" class="form-control input-md" value="{{ $id->Name }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="StreetAddress">Street Address</label>
                <div class="col-md-4">
                    <input id="StreetAddress" name="StreetAddress" type="text" class="form-control input-md" value="{{ $id->StreetAddress }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="StreetAddress2">Street Address 2</label>
                <div class="col-md-4">
                    <input id="StreetAddress2" name="StreetAddress2" type="text" class="form-control input-md" value="{{ $id->StreetAddress2 }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="City">City</label>
                <div class="col-md-4">
                    <input id="City" name="City" type="text" class="form-control input-md" value="{{ $id->City }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="County">County</label>
                <div class="col-md-4">
                    <input id="county" name="County" type="text" class="form-control input-md" value="{{ $id->County }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="State">State</label>
                <div class="col-md-4">
                    <select id="State" name="State" class="form-control">
                    <?php
                    $stateCode = array('AL', 'AK', 'AZ', 'AR', 'CA', 'CO', 'CT', 'DE', 'DC',
                            'FL', 'GA', 'HI', 'ID', 'IL', 'IN', 'IA', 'KS', 'KY', 'LA', 'ME', 'MD',
                            'MA', 'MI', 'MN', 'MS', 'MO', 'MT', 'NE', 'NV', 'NH', 'NJ', 'NM', 'NY',
                            'NC', 'ND', 'OH', 'OK', 'OR', 'PA', 'RI', 'SC', 'SD', 'TN', 'TX', 'UT',
                            'VT', 'VA', 'WA', 'WV', 'WI', 'WY');

                    $stateName = array('Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California', 'Colorado',
                                    'Connecticut', 'Delaware', 'District of Columbia', 'Florida', 'Georgia',
                                    'Hawaii', 'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky',
                                    'Louisiana', 'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota',
                                    'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire',
                                    'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota', 'Ohio',
                                    'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island', 'South Carolina', 'South Dakota',
                                    'Tennessee', 'Texas', 'Utah', 'Vermont', 'Virginia', 'Washington', 'West Virginia',
                                    'Wisconsin', 'Wyoming');
                        $state = $id['State'] ;


                        for($i=0;$i<51;$i++)
                            {
                                $string = '<option value="'.$stateCode[$i].'"';
                                if($stateCode[$i] == $state)
                                    {
                                        $string .= ' selected';
                                    }
                                $string .= '>'.$stateName[$i].'</option>';
                                echo $string;
                            }

                    ?>



                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="Zipcode">Zipcode</label>
                <div class="col-md-4">
                    <input id="Zipcode" name="Zipcode" type="text" class="form-control input-md" value="{{ $id->Zipcode }}">
                </div>
            </div>
            <hr />

            <div class="form-group">
                <label class="col-md-2 control-label" for="PhoneNumber">Phone Number</label>
                <div class="col-md-4">
                    <input id="PhoneNumber" name="PhoneNumber" type="tel" class="form-control input-md" value="{{ $id->ContactPhone }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="OpeningHours">Opening Time</label>
                <div class="col-md-4">
                    <input id="OpeningHours" name="OpeningHours" type="time" class="form-control input-md" value="{{ $id->OpeningHours }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="ClosingHours">Closing Time</label>
                <div class="col-md-4">
                    <input id="ClosingHours" name="ClosingHours" type="time" class="form-control input-md" value="{{ $id->ClosingHours }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="Comments">Comments</label>
                <div class="col-md-4">
                    <textarea name="Comments" id="Comments" cols="30" rows="4" class="form-control input-md">{{ $id->Comments }}</textarea>
                </div>
            </div>
            <div class="col-md-5 text-center">
                <input class="btn btn-primary" type="submit" value="Update">
            </div>
        </form>
    </div>
@endsection