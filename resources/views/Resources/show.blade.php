@extends('layouts.general')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

                        <h2><em>{{ $resource->Name }}</em></h2>
            <div class="col-md-4">
                <p><b>Address:</b></p>
                {{--If there is a street 2, display. Else do not--}}
                @if($resource->StreedAddress2 != null)
                    <p>{{ $resource->StreetAddress }}<br>
                        {{ $resource->StreetAddress2 }}</p>
                @else
                    <p>{{ $resource->StreetAddress }}</p>
                @endif

                <p>{{ $resource->City }}, {{ $resource->State }} {{ $resource->Zipcode }}</p>
                <p>{{ $resource->County }}</p>
            </div>
            <div class="col-md-2">
                <p><b>Hours:</b></p>
                <p>{{ $resource->OpeningHours }} - {{ $resource->ClosingHours }}</p>
            </div>
            <div class="col-md-4">
                <p><b>Contacts:</b></p>
                @foreach($resource->contacts as $contact)
                    <p>
                        <a href="{{ URL::to('contacts/' . $contact->id) }}">
                            {{ $contact->full_name }}
                        </a>
                    </p>
                @endforeach
            </div>
            <div class="col-md-10">
                <hr />
                <p><b>Description:</b></p>
                <p>Lorem ipsum dolor sit amet, qui malis vituperatoribus an, hinc tractatos facilisis an sit. Te est
                    diceret sanctus, an movet commune lobortis qui. Nobis maluisset intellegat sea ad, est liber dolor
                    in. Vel cu quodsi doctus, te eirmod deleniti eam. Mei id rebum nemore corpora, sit modo debitis
                    accumsan in. Ei mea quas discere, error debitis eu qui, quem antiopam dignissim id vim. Mea ut
                    aperiam accusamus.</p>

                <p><b>Categories</b></p>
                <p>
                @foreach ($resource->categories as $category)
                        <a href="{{ URL::to('categories/' . $category->id) }}">
                           | {{ $category->name }}
                        </a>
                @endforeach
                | </p>
                <hr />
                <p><b>Comments:</b></p>
                <p>{{ $resource->Comments }}</p>
                <hr />
            </div>
            <div class="col-md-10">
                <dt>Reported Problems</dt>
                @if(isset($resource->flags))
                    @foreach($resource->flags as $flag)
                        @if(!$flag->resolved)
                            <dd>{{ $flag->comments }}</dd>
                        @endif
                    @endforeach
                @else
                    <dd>No problems reported</dd>
                @endif
                <div class="col-md-10">
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <!-- edit this resource (uses the edit method found at GET /resource/edit/{id} -->
                    <a class="btn btn-lg btn-info" href="{{ URL::to('resources/' . $resource->id. '/edit') }}">Edit</a>
                    <!-- delete the resource -->
                    <!-- Trigger the modal with a button -->
                    <button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#deleteModal">Delete</button>
                    <div class="col-md-offset-2"><br/><br/>
                        <div>
                            <a href="{{'/resources'}}">Back to Resources</a></br>

                            <!-- Flag this resource as incorrect -->
                            <a  href="{{ URL::to('resources/' . $resource->id. '/flag') }}">Report a problem with this resource.</a>
                        </div>
                    </div>
                    <br/>
                    <br/>
                </div>
            </div>

    </div>
    <!-- Modal -->
    @include('Resources._deleteModal')
@endsection