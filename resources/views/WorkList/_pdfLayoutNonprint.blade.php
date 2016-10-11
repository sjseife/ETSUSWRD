@foreach($resources as $r)
    <div class="container">
        <div class="underlined-title">
            <div class="editContent">
                <h1 class="img-rounded" style="background-color: #f6f6f7; padding: 5px; padding-left: 20px">
                    {{$r->name}}
                    <a class="btn btn-small btn-primary pull-right" href="{{ URL::to('resources/removeReport/' . $r->id) }}">Remove from Cart</a>
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-12 col-xs-12 pad15">
                <div class="col-xs-2">
                </div>
                <div class="col-xs-10">
                    <div class="editContent">
                        <h4 class="img-rounded" style="background-color: #f6f6f7; padding: 5px">Address</h4>
                    </div>
                    <div class="editContent">
                        <p>
                            {{$r->streetAddress}}<br>
                            @if($r->streetAddress2 != null)
                                {{$r->streetAddress2}}<br>
                            @endif
                            {{$r->city}}, {{$r->state}} {{$r->zipCode}}<br>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12 col-xs-12 pad215">
                <div class="col-xs-2">
                </div>
                <div class="col-xs-10">
                    <div class="editContent">
                        <h4 class="img-rounded" style="background-color: #f6f6f7; padding: 5px">Hours</h4>
                    </div>
                    <div class="editContent">
                        <ul>
                            @foreach($r->hours as $day)
                                <li>{{ $day->day }} : {{ date('g:i A', strtotime($day->openTime)) }} - {{ date('g:i A', strtotime($day->closeTime)) }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12 col-xs-12 pad15">
                <div class="col-xs-2">
                </div>
                <div class="col-xs-10">
                    <div class="editContent">
                        <h4 class="img-rounded" style="background-color: #f6f6f7; padding: 5px">Description</h4>
                    </div>
                    <div class="editContent">
                        <p>{{$r->description}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12 col-xs-12 pad15">
                <div class="col-xs-2">
                </div>
                <div class="col-xs-10">
                    <div class="editContent">
                        <h4 class="img-rounded" style="background-color: #f6f6f7; padding: 5px">Comments</h4>
                    </div>
                    <div class="editContent">
                        <p>{{$r->comments}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12 col-xs-12 pad15">
                <div class="col-xs-2">
                </div>
                <div class="col-xs-10">
                    <div class="editContent">
                        <h4 class="img-rounded" style="background-color: #f6f6f7; padding: 5px">Contact Information</h4>
                    </div>
                    <div class="editContent">
                       <p>{{ $r->publicPhoneNumber }}</p>
                        <p>{{ $r->publicEmail }}</p>
                        <p>{{ $r->website }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12 col-xs-12 pad15">
                <div class="col-xs-2">
                </div>
                <div class="col-xs-10">
                    <div class="editContent">
                        <h4 class="img-rounded" style="background-color: #f6f6f7; padding: 5px">Categories</h4>
                    </div>
                    <div class="editContent">
                        <ul>
                            @foreach($r->categories as $category)
                                <li> {{$category->name}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div><!-- /.row -->
        <hr/>
        <br/>
        <br/>
    </div><!-- /.container -->
@endforeach