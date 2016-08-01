@extends('layouts.dataTables')

@section('content')
    <h1 class="text-center">All Resources</h1>

    <div class="container">
        <!-- create a new resource (uses the create method found at GET /resource/create -->
        <a class="btn btn-small btn-primary pull-right" href="{{ URL::to('resource/create') }}" style="margin-bottom: 20px;">Create New Resource</a>
        <div class="row">
            <table class="table table-striped table-bordered" id="ResourceTable">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>County</th>
                    <th>Opening Hours</th>
                    <th>Closing Hours</th>
                    <th>Status</th>
                    <th>Contacts</th>
                    <th>Add to Report</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($resources as $key => $value)
                    <?php $link = false; ?>
                    <tr>
                        <td>{{ $value->Name }}</td>
                        <td>{{ $value->County }}</td>
                        <td>{{ $value->OpeningHours }}</td>
                        <td>{{ $value->ClosingHours }}</td>
                        <td>
                            @foreach($flags as $f)
                                @if($f->resource_id == $value->Id && $link == false)
                                    <a href="flag/resourceview/{{$value->Id}}" class="btn btn-danger btn-sm">Flagged</a>
                                    <?php $link = true; ?>
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach($contacts as $c)
                                @if($c->resource_id == $value->Id)
                                    <a href="contact/view/{{$c->id}}" class="btn btn-warning btn-sm">{{$c->firstName}} {{$c->lastName}}</a>
                                    <?php $link = true; ?>
                                @endif
                            @endforeach
                        </td>
                        <td>
                            <a class="btn btn-small btn-primary" href="{{ URL::to('resource/add/' . $value->Id) }}">Add to Cart</a>

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

    </div>

@stop
<<<<<<< HEAD

=======
>>>>>>> 3788ba697b338a037178a2e96b528c0368e9bf2b
@push('scripts')
<script>
    $(document).ready(function() {
        $('#ResourceTable').DataTable();
    });
</script>
@endpush