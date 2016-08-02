@extends('layouts.dataTables')

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
                    <th>Category</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($resources as $key => $resource)
                    <?php $link = false; ?>
                    <tr>
                        <td>{{ $resource->Name }}</td>
                        <td>{{ $resource->County }}</td>
                        <td>{{ $resource->ContactPhone }}</td>
                        <td>{{ $resource->OpeningHours }}</td>
                        <td>{{ $resource->ClosingHours }}</td>
                        <td>
                            @foreach ($resource->categories as $category)
                                {{ $category->name }}
                            @endforeach
                        </td>
                        <td class="text-center col-md-3">

                            <!-- show the resource (uses the show method found at GET /resource/view/{id} -->
                            <a class="btn btn-small btn-success" href="{{ URL::to('resources/' . $resource->id) }}">View</a>

                            {{--<!-- edit this resource (uses the edit method found at GET /resource/edit/{id} -->
                            <a class="btn btn-small btn-info" href="{{ URL::to('resources/edit/' . $resource->id) }}">Edit</a>

                            <!-- delete the resource (uses the delete method found at GET /resource/{id} -->
                            <a class="btn btn-small btn-warning" href="{{ URL::to('resources/delete/' . $resource->id) }}">Delete</a>--}}

                            <a class="btn btn-small btn-primary" href="{{ URL::to('resources/add/' . $resource->id) }}">Add to Cart</a>

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