@extends('layouts.dataTables')

@section('content')
    <h1 class="text-center">All Resources</h1>

    <div class="container">
        <!-- create a new resource (uses the create method found at GET /resource/create -->
        <a class="btn btn-lg btn-primary pull-right" href="{{ URL::to('resources/create') }}" style="margin-bottom: 20px;">Create New Resource</a>
        <br>
        <br>
        <div>
            <table style="display:none;" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" id="ResourceTable">
                <thead>

                    <tr>
                        <!-- class all for always show, lower data priority numbers stay longer-->
                        <th class="all" >Name</th>
                        <th data-priority="1">County</th>
                        <th data-priority="1">Category</th>
                        <th data-priority="2">Phone</th>
                        <th data-priority="2">Hours of Operation</th>
                        <th data-priority="3">Street Address</th>
                        <th data-priority="2">City</th>
                        <th data-priority="1">State</th>
                        <th data-priority="2">Zip Code</th>
                        <th data-priority="3">Contact(s)</th>
                        <th data-priority="3">Comments</th>
                        <th class="all">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                @foreach($resources as $key => $resource)
                    <?php
                        $link = false;
                    ?>
                    <tr>
                        <td>{{ $resource->Name }}</td>
                        <td>{{ $resource->County }}</td>
                        <td>
                            @foreach ($resource->categories as $category)
                                {{ $category->name }}
                            @endforeach
                        </td>
                        <td>{{ $resource->PhoneNumber }}</td>
                        <td>{{ date('g:i A', strtotime($resource->OpeningHours)) }} - {{ date('g:i A', strtotime($resource->ClosingHours)) }}</td>
                        <td>{{ $resource->StreetAddress }} <br> {{ $resource->StreetAddress2 }}</td>
                        <td>{{ $resource->City }}</td>
                        <td>{{ $resource->State }}</td>
                        <td>{{ $resource->Zipcode }}</td>
                        <td>
                           <ul>
                               @foreach($resource->contacts as $contact)
                                   {{ $contact->full_name }}: {{$contact->phoneNumber}}
                                   <br>
                               @endforeach
                           </ul>
                        </td>
                        <td>{{ $resource->Comments }}</td>
                        <td class="text-center col-md-3">

                            <!-- show the resource (uses the show method found at GET /resource/view/{id} -->
                            <a class="btn btn-sm btn-success" href="{{ URL::to('resources/' . $resource->id) }}">View</a>
                            <button type="button" class="btn btn-sm btn-primary addReport" name="{{$resource->id}}">Add to Report</button>
                           {{-- <a class="btn btn-sm btn-primary" href="{{ URL::to('resources/addAjax/'. $resource->id) }}">Add to Report</a>--}}

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

        //Apply DataTables
        $('#ResourceTable').dataTable( {
            initComplete: function () {
                this.api().columns([1,2,4,5,6,7,8,9]).every( function () {
                    var column = this;
                    var select = $('<select><option value=""></option></select>')
                            .appendTo( $(column.footer()).empty() )
                            .on( 'change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                );

                                column
                                        .search( val ? '^'+val+'$' : '', true, false )
                                        .draw();
                            } );

                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                } );

            },
            "fnDrawCallback":function(){
                $(this).show();
            }
        } );


    } );
    //Ajax for add to report button
    $('.addReport').each(function() {
        $(this).click(function (){
            console.log($(this).attr("name"));
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "GET",
                url: 'resources/add/' + $(this).attr("name"),
                dataType: 'json',
                success: function (data) {
                    console.log(data.status);
                    /*//alerts users to successful creation of contact.
                     html = '<div class="alert alert-success"><ul><li>Contact created succesfully!</li></ul></div>';
                     $('#form-success').html(html);

                     //Automatically add new contact to select box, and select them
                     var newOption = new Option(data.firstName + ' ' + data.lastName, data.id, false, true);
                     $("#contact_list").append(newOption).trigger('change');

                     //Finally, Reset new contact form and close modal

                     $('#firstName').val("");
                     $('#lastName').val("");
                     $('#email').val("");
                     $('#phoneNumber').val("");
                     $('#resource_list > option').each(function () {
                     $(this).removeAttr("selected");
                     });

                     $('#resource_list').trigger('change');
                     $('#createContactModal').modal('toggle');*/




                },
                error: function (data) {
                    console.log(data.status);
                    /*if (data.status === 401) //redirect if not authenticated user.
                     $(location).prop('pathname', 'auth/login');
                     if (data.status === 422) {
                     //process validation errors here.
                     var errors = data.responseJSON; //this will get the errors response data.
                     //show them somewhere in the modal
                     errorsHtml = '<div class="alert alert-danger"><ul>';

                     $.each(errors, function (key, value) {
                     errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
                     });
                     errorsHtml += '</ul></di>';

                     $('#form-errors').html(errorsHtml); //appending to a <div id="form-errors"></div> inside form
                     } else {
                     html = '<div class="alert alert-danger"><ul><li>There was a problem processing your request. ' +
                     'Please try again later.</li></ul></div>';
                     $('#form-errors').html(html); //appending to a <div id="form-errors"></div> inside form
                     }*/
                }
            });
        });
    });

</script>

@endpush