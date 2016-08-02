@extends('layouts.dashboard')

@section('content')
    <h1 class="text-center">All Resources</h1>

    <div class="container">
        <!-- create a new resource (uses the create method found at GET /resource/create -->
        <a class="btn btn-small btn-primary pull-right" href="{{ URL::to('resources/create') }}" style="margin-bottom: 20px;">Create New Resource</a>
        <div class="row">
            <table class="table table-striped table-bordered" id="ResourceTable">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>County</th>
                    <th>Phone</th>
                    <th>Opening Hours</th>
                    <th>Closing Hours</th>
                    <th>Status</th>
                    <th>Contacts</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($resources as $key => $resource)
                    <?php $link = false; ?>
                    <tr>
                        <td>{{ $resource->Name }}</td>
                        <td>{{ $resource->County }}</td>
                        <td>{{ $resource->PhoneNumber }}</td>
                        <td>{{ $resource->OpeningHours }}</td>
                        <td>{{ $resource->ClosingHours }}</td>
                        <td>
                            @foreach($flags as $f)
                                @if($f->resource_id == $resource->Id && $link == false)
                                    <a href="flag/resourceview/{{$resource->Id}}" class="btn btn-danger btn-sm">Flagged</a>
                                    <?php $link = true; ?>
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach($contacts as $c)
                                @if($c->resource_id == $resource->Id)
                                    <a href="contact/view/{{$c->id}}" class="btn btn-warning btn-sm">{{$c->firstName}} {{$c->lastName}}</a>
                                    <?php $link = true; ?>
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach ($resource->categories as $category)
                                {{ $category->name }}
                            @endforeach
                        </td>
                        <td class="text-center col-md-3">
                            <!-- show the resource (uses the show method found at GET /resource/view/{id} -->
                            <a class="btn btn-small btn-success" href="{{ URL::to('resources/' . $resource->Id) }}">View</a>
                            <!-- add resource to cart-->
                            <a class="btn btn-small btn-primary" href="{{ URL::to('resource/add/' . $resource->Id) }}">Add to Cart</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>

@stop
@push('scripts')
<script>
    $(document).ready(function() {
        $('#ResourceTable').DataTable();
    });
</script>
@endpush