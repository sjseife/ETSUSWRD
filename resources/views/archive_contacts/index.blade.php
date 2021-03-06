@extends('layouts.dataTables')

@section('content')
    <style>
        .table-bordered{
            border-bottom: solid 3px  #041E42!important;
        }
    </style>
    <div class="text-center"><h1 class="page-header">All Archived Contacts</h1></div>
    <div class="container">
        <div class="row">
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%"id="ContactsTable">
                <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>View</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($contacts as $key => $contact)
                    <?php $link = false; ?>
                    <tr>
                        <td>{{ $contact->firstName }}</td>
                        <td>{{ $contact->lastName }}</td>
                        <td>{{ $contact->protectedEmail }}</td>
                        <td><?php
                            $tempPhoneNumber = $contact->protectedPhoneNumber;
                            $tempPhoneNumber = preg_replace("/[^0-9,x]/", "", $tempPhoneNumber );
                            if(strlen($tempPhoneNumber) > 10)
                            {
                                $tempPhoneNumber = preg_replace("/^[1]/", "", $tempPhoneNumber );
                            }
                            $tempPhoneNumber = '(' . substr($tempPhoneNumber,0, 3) . ') '
                                    . substr($tempPhoneNumber, 3, 3) . '-'
                                    . substr($tempPhoneNumber, 6, 4) . ' '
                                    . substr($tempPhoneNumber, 10, (strlen($tempPhoneNumber) - 10));
                            echo $tempPhoneNumber;

                            ?></td>
                        <td class="text-center">

                            <!-- show the contact (uses the show method found at GET /contacts/{id} -->
                            <a class="btn btn-small btn-success" href="{{ URL::to('archive_contacts/' . $contact->id) }}">View</a>

                        </td>
                        <td class="text-center ">


                            <!-- show the event (uses the show method found at GET /event/view/{id} -->
                            {{--<a class="btn btn-sm btn-success" href="{{ URL::to('events/' . $event->id) }}">View</a>--}}
                            <button type="button" class="btn btn-sm btn-primary report
                                addReport" name="{{$contact->id}}">Restore</button>
                            {{-- <a class="btn btn-sm btn-primary" href="{{ URL::to('events/addAjax/'. $event->id) }}">Add to Report</a>--}}
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

    @if (session()->has('flash_notification.message'))
        @if(session('flash_notification.level') == 'success')
            toastr.success('{{session('flash_notification.message')}}');
        @elseif(session('flash_notification.level') == 'danger')
            toastr.error('{{session('flash_notification.message')}}');
        @elseif(session('flash_notification.level') == 'info')
            toastr.info('{{session('flash_notification.message')}}');
        @endif
    @endif

$(document).ready(function() {
        $('#ContactsTable').DataTable();

        $('#ContactsTable').on('click', '.report', function(){
            var button = $(this);
            var index = button.attr("name");
            var remove = $(this).hasClass("removeReport");
            var add = $(this).hasClass("addReport");
                    <?php
                    $contactNames = array('empty');
                    foreach($contacts as $contact)
                    {
                        $contactNames[$contact->id] = $contact->firstName . ' ' . $contact->lastName;
                    }
                    ?>
            var contactNames = <?php echo json_encode($contactNames); ?>;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            if (add) {
                $.ajax({

                    type: "GET",
                    url: 'archive_contacts/restore/' + $(this).attr("name"),
                    dataType: 'json',
                    success: function (data) {
                        //alerts users to successful button pushing.
                        /*html = '<div class="alert alert-success">' + contactNames[index] + ' restored to contact page!<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>';
                        $('#successOrFailure').html(html);*/
                        toastr["success"]( contactNames[index] + " successfully restored to contacts", "Contact Restored");

                        button.css({"background-color": "#FFC72C", "color": "#041E42", "border-color": "#FFC72C"});
                        button.addClass('disabled').removeClass('addReport');
                        button.text(function (i, text) {
                            return "Contact Restored";
                        })

                    },
                    error: function (data) {
                        if (data.status === 401) //redirect if not authenticated user.
                            $(location).prop('pathname', 'auth/login');
                        if (data.status === 422) {
                            //process validation errors here.
                            var errors = data.responseJSON; //this will get the errors response data.
                            //show them somewhere in the modal
                            errorsHtml = '<div class="alert alert-danger"><ul>';

                            $.each(errors, function (key, value) {
                                errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
                            });
                            errorsHtml += '</ul><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>';

                            $('#successOrFailure').html(errorsHtml); //appending to a <div id="form-errors"></div> inside form
                        } else {
                            html = '<div class="alert alert-danger"><ul><li>There was a problem processing your request. ' +
                                    'Please try again later.</li></ul><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>';
                            $('#successOrFailure').html(html);
                        }
                    }
                });
            }
        });
    });
</script>
@endpush