@extends('layouts.dashboard')

@section('content')
    <h1 class="text-center">All Categories</h1>

    <div class="container">
        <!-- create a new category (uses the create method found at GET /category/create -->
        <a class="btn btn-small btn-primary pull-right" href="{{ URL::to('category/create') }}" style="margin-bottom: 20px;">Create New Category</a>
        <div class="row">
            <table class="table table-striped table-bordered" id="CategoryTable">
                <thead>
                <tr>
                    <th>Name</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $key => $value)
                    <tr>
                        <td>{{ $value->name }}</td>
                        <td class="text-center col-md-3">

                            <!-- show the category (uses the show method found at GET /category/view/{id} -->
                            <a class="btn btn-small btn-success" href="{{ URL::to('category/view/' . $value->id) }}">View</a>

                            <!-- edit this category (uses the edit method found at GET /category/edit/{id} -->
                            <a class="btn btn-small btn-info" href="{{ URL::to('category/edit/' . $value->id) }}">Edit</a>
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
        $('#CategoryTable').DataTable();
    });
</script>
@endpush