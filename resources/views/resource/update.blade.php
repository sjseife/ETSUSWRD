@extends('layouts.app')

@section('content')
    <div class="content">
        <form class="form-horizontal" method="POST" action="/resource/{{$id->Id}}">
            {{ method_field('PATCH') }}
            {{ csrf_field() }}
            <div class="form-group">
                <label class="col-md-2 control-label" for="Name">Name</label>
                <div class="col-md-4">
                    <input id="name" name="Name" type="text" class="form-control input-md" value="{{ $id->Name }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="StreetAddress">Street Address</label>
                <div class="col-md-4">
                    <input id="streetaddress" name="StreetAddress" type="text" class="form-control input-md" value="{{ $id->StreetAddress }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="StreetAddress2">Street Address 2</label>
                <div class="col-md-4">
                    <input id="streetaddress2" name="StreetAddress2" type="text" class="form-control input-md" value="{{ $id->StreetAddress2 }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="City">City</label>
                <div class="col-md-4">
                    <input id="city" name="City" type="text" class="form-control input-md" value="{{ $id->City }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="State">State</label>
                <div class="col-md-4">
                    <select name="State" class="form-control">
                        <option value="AL">Alabama</option>
                        <option value="AK">Alaska</option>
                        <option value="AZ">Arizona</option>
                        <option value="AR">Arkansas</option>
                        <option value="CA">California</option>
                        <option value="CO">Colorado</option>
                        <option value="CT">Connecticut</option>
                        <option value="DE">Delaware</option>
                        <option value="DC">District Of Columbia</option>
                        <option value="FL">Florida</option>
                        <option value="GA">Georgia</option>
                        <option value="HI">Hawaii</option>
                        <option value="ID">Idaho</option>
                        <option value="IL">Illinois</option>
                        <option value="IN">Indiana</option>
                        <option value="IA">Iowa</option>
                        <option value="KS">Kansas</option>
                        <option value="KY">Kentucky</option>
                        <option value="LA">Louisiana</option>
                        <option value="ME">Maine</option>
                        <option value="MD">Maryland</option>
                        <option value="MA">Massachusetts</option>
                        <option value="MI">Michigan</option>
                        <option value="MN">Minnesota</option>
                        <option value="MS">Mississippi</option>
                        <option value="MO">Missouri</option>
                        <option value="MT">Montana</option>
                        <option value="NE">Nebraska</option>
                        <option value="NV">Nevada</option>
                        <option value="NH">New Hampshire</option>
                        <option value="NJ">New Jersey</option>
                        <option value="NM">New Mexico</option>
                        <option value="NY">New York</option>
                        <option value="NC">North Carolina</option>
                        <option value="ND">North Dakota</option>
                        <option value="OH">Ohio</option>
                        <option value="OK">Oklahoma</option>
                        <option value="OR">Oregon</option>
                        <option value="PA">Pennsylvania</option>
                        <option value="RI">Rhode Island</option>
                        <option value="SC">South Carolina</option>
                        <option value="SD">South Dakota</option>
                        <option value="TN">Tennessee</option>
                        <option value="TX">Texas</option>
                        <option value="UT">Utah</option>
                        <option value="VT">Vermont</option>
                        <option value="VA">Virginia</option>
                        <option value="WA">Washington</option>
                        <option value="WV">West Virginia</option>
                        <option value="WI">Wisconsin</option>
                        <option value="WY">Wyoming</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="Zipcode">Zipcode</label>
                <div class="col-md-4">
                    <input id="Zipcode" name="Zipcode" type="text" class="form-control input-md" value="{{ $id->Zipcode }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="County">County</label>
                <div class="col-md-4">
                    <input id="county" name="County" type="text" class="form-control input-md" value="{{ $id->County }}">
                </div>
            </div>
            <hr />
            <div class="form-group">
                <label class="col-md-2 control-label" for="ContactFirstName">Contact First Name</label>
                <div class="col-md-4">
                    <input id="ContactFirstName" name="ContactFirstName" type="text" class="form-control input-md" value="{{ $id->ContactFirstName }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="ContactLastName">Contact Last Name</label>
                <div class="col-md-4">
                    <input id="ContactLastName" name="ContactLastName" type="text" class="form-control input-md" value="{{ $id->ContactLastName }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="ContactPhone">Phone Number</label>
                <div class="col-md-4">
                    <input id="ContactPhone" name="ContactPhone" type="tel" class="form-control input-md" value="{{ $id->ContactPhone }}">
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