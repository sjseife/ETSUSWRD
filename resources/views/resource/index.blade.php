@extends('layouts.app')
@section('content')
    <h1 class="text-center">All Resources</h1>

    <div class="container">
        <div class="row">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <td><b>Name</b></td>
                    <td><b>County</b></td>
                    <td><b>Contact First Name</b></td>
                    <td><b>Contact Last Name</b></td>
                    <td><b>Phone</b></td>
                    <td><b>Opening Hours</b></td>
                    <td><b>Closing Hours</b></td>
                    <td><b>Status</b></td>
                </tr>
                </thead>
                <tbody>
                @foreach($resources as $key => $value)
                    <?php $link = false; ?>
                    <tr>
                        <td>{{ $value->Name }}</td>
                        <td>{{ $value->County }}</td>
                        <td>{{ $value->ContactFirstName }}</td>
                        <td>{{ $value->ContactLastName }}</td>
                        <td>{{ $value->ContactPhone }}</td>
                        <td>{{ $value->OpeningHours }}</td>
                        <td>{{ $value->ClosingHours }}</td>
                        <td>
                            @foreach($flag as $f)
                                @if($f->resource_id == $value->Id && $link == false)
                                    <a href="flag/resourceview/{{$value->Id}}" class="btn btn-danger btn-sm">Flagged</a>
                                    <?php $link = true; ?>
                                @endif
                            @endforeach
                        </td>
                        <td class="text-center col-md-3">

                            <!-- show the resource (uses the show method found at GET /resource/view/{id} -->
                            <a class="btn btn-small btn-success" href="{{ URL::to('resource/view/' . $value->Id) }}">View</a>

                            <!-- edit this resource (uses the edit method found at GET /resource/edit/{id} -->
                            <a class="btn btn-small btn-info" href="{{ URL::to('resource/edit/' . $value->Id) }}">Edit</a>

                            <!-- delete the resource (uses the delete method found at GET /resource/{id} -->
                            <a class="btn btn-small btn-warning" href="{{ URL::to('resource/delete/' . $value->Id) }}">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- create a new resource (uses the create method found at GET /resource/create -->
        <a class="btn btn-small btn-primary pull-right" href="{{ URL::to('resource/create') }}">Create New Resource</a>
    </div>
@endsection