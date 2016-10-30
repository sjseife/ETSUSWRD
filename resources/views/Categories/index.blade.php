@extends('layouts.dataTables')

@section('content')
    <style>
        .table-bordered{
            border-bottom: solid 3px  #041E42!important;
        }
    </style>
    <div class="text-center"><h1 class="page-header">All Categories</h1></div>
    <div class="container">
        <!-- create a new category (uses the create method found at GET /categories/create -->
        <a class="btn btn-small btn-primary pull-right" href="{{ URL::to('categories/create') }}" style="margin-bottom: 20px;">Create New Category</a>
        <br />
        <br />
        <div class="row">
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%"id="CategoryTable">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>View</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $key => $category)
                    <?php $link = false; ?>
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td class="text-center">

                            <!-- show the contact (uses the show method found at GET /contacts/{id} -->
                            <a class="btn btn-small btn-success" href="{{ URL::to('categories/' . $category->id) }}">View</a>

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