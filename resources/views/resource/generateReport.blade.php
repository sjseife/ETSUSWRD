@extends('layouts.dataTables')

@section('content')

    @foreach($resources as $r)
    <div class="container">

        <div class="underlined-title">
            <div class="editContent">
                <h1 class="img-rounded" style="background-color: #f6f6f7; padding: 5px; padding-left: 20px">
                    {{$r->Name}}
                    <div class="pull-right"><h3>{{$r->ContactPhone}}</h3>
                    </div>
                </h1>
            </div>

        </div>

        <div class="row">

            <div class="col-md-4 col-sm-12 col-xs-12 pad25">
                <div class="col-xs-2">
                </div>
                <div class="col-xs-10">
                    <div class="editContent">
                        <h4 class="img-rounded" style="background-color: #f6f6f7; padding: 5px">Address</h4>
                    </div>
                    <div class="editContent">
                        <p>
                            {{$r->StreetAddress}}</br>
                            @if($r->StreetAddress2 != null)
                                {{$r->StreetAddress2}}</br>
                            @endif
                            {{$r->City}}, {{$r->State}} {{$r->Zipcode}}</br>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-12 col-xs-12 pad25">
                <div class="col-xs-2">
                </div>
                <div class="col-xs-10">
                    <div class="editContent">
                        <h4 class="img-rounded" style="background-color: #f6f6f7; padding: 5px">Contact</h4>
                    </div>
                    <div class="editContent">
                        <p>
                            <b>Name:</b> {{$r->ContactFirstName}} {{$r->ContactLastName}}</br>
                            <b>Phone:</b> {{$r->ContactPhone}}</br>
                            <b>Hours:</b> {{$r->OpeningHours}} - {{$r->ClosingHours}}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-12 col-xs-12 pad25">
                <div class="col-xs-2">
                </div>
                <div class="col-xs-10">
                    <div class="editContent">
                        <h4 class="img-rounded" style="background-color: #f6f6f7; padding: 5px">Comments</h4>
                    </div>
                    <div class="editContent">
                        <p>{{$r->Comments}}</p>
                    </div>
                </div>
            </div>

        </div><!-- /.row -->
        <hr>
    </div><!-- /.container -->
    @endforeach

@endsection