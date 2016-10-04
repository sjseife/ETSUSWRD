@extends('layouts.dataTables')

@section('content')
    <h1 class="text-center">All Resources</h1>

    <div class="container">
        <!-- create a new resource (uses the create method found at GET /resource/create -->
        <a class="btn btn-small btn-primary pull-right" href="{{ URL::to('resources/create') }}" style="margin-bottom: 20px;">Create New Resource</a>
        <div class="row">
            <table class="display dt-responsive nowrap" cellspacing="0" width="100%" id="ResourceTable">
                <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>County</th>
                    <th></th>
                    <th>Hours of Operation</th>
                    <th>Category</th>
                    <th></th>
                </tr>

                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>County</th>
                    <th>Phone</th>
                    <th>Hours of Operation</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($resources as $key => $resource)
                    <?php
                        $link = false;
                    ?>
                    <tr>
                        <td class="details-control"></td>
                        <td>{{ $resource->Name }}</td>
                        <td>{{ $resource->County }}</td>
                        <td>{{ $resource->PhoneNumber }}</td>
                        <td>{{ date('g:i A', strtotime($resource->OpeningHours)) }} - {{ date('g:i A', strtotime($resource->ClosingHours)) }}</td>
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

                            <a class="btn btn-small btn-primary" href="{{ URL::to('resources/add/'. $resource->id) }}">Add to Report</a>

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
    function format ( d ) {
        // `d` is the original data object for the row
        return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
                '<tr>'+
                '<td>Full name:</td>'+
                '<td></td>'+
                '</tr>'+
                '<tr>'+
                '<td>Extension number:</td>'+
                '<td></td>'+
                '</tr>'+
                '<tr>'+
                '<td>Extra info:</td>'+
                '<td>And any further details here (images etc)...</td>'+
                '</tr>'+
                '</table>';
    }

    $(document).ready(function() {

        var table = $('#ResourceTable').DataTable();

        $("#ResourceTable thead th").each( function ( i )
        {
                if (i < 6 )
                {
                    if (i!= 0 && i != 1 && i != 3 && i != 5) {
                        var select = $('<select class=' + i + '><option value=""></option></select>')
                                .appendTo($(this).empty())
                                .on('change', function () {

                                    var val = $(this).val();

                                    table.column(i) //all columns except those excluded by the if statement
                                            .search(val ? '^' + $(this).val() + '$' : val, true, false)
                                            .draw();
                                });
                        table.column(i).data().unique().sort().each(function (d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>');
                        });
                    }
                    if(i == 1)
                    {
                        var select = $('<select class=' + i + '><option value=""></option></select>')
                                .appendTo($(this).empty())
                                .on('change', function () {

                                    var val = $(this).val();

                                    table.column(i) //Only the name column
                                            .search(val ? '^' + $(this).val() : val, true, false)
                                            .draw();
                                });
                        var letter = 'A';
                        for(y = 0; y < 26; y ++)
                        {
                            letter = String.fromCharCode('A'.charCodeAt() + y);
                            select.append('<option value="' + letter + '">' + letter + '</option>');
                        }
                    }
                    if(i == 5)
                    {
                        var select = $('<select class=' + i + '><option value=""></option></select>')
                                .appendTo($(this).empty())
                                .on('change', function () {

                                    var val = $(this).val();

                                    table.column(i) //Only the name column
                                            .search(val ? $(this).val() : val, true, false)
                                            .draw();
                                });
                        var categories = <?php echo json_encode($categories); ?>

                        for(y = 0; y < categories.length; y++)
                        {
                             select.append('<option value="' + categories[y] + '">' + categories[y] + '</option>');
                        }

                    }
                }
        });

        $('#ResourceTable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row( tr );

            if ( row.child.isShown() ) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            }
            else {
                // Open this row
                row.child( format(row.data()) ).show();
                tr.addClass('shown');
            }
        } );
    } );
</script>
@endpush