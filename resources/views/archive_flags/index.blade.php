@extends('layouts.dataTables')

@section('content')
    <style>
        .table-bordered{
            border-bottom: solid 3px  #041E42!important;
        }
    </style>
    <div class="text-center"><h1 class="page-header">All Archived Flags</h1></div>
    <div class="container">
        <div class="row">
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" id="FlagsTable">
                <thead>
                <tr>
                    <th>Type</th>
                    <th>Name</th>
                    <th>Flagged For</th>
                    <th>Submitted By</th>
                    <th>Submitted At</th>
                    <th>Status</th>
                    <th>View</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($flags as $key => $flag)
                    <?php $link = false; ?>
                    <tr>
                        @if(isset($flag->resource))
                            <td>Resource</td>
                            <td>{{ $flag->resource->name }}</td>
                        @elseif(isset($flag->contact))
                            <td>Contact</td>
                            <td>{{ $flag->contact->full_name }}</td>
                        @elseif(isset($flag->user))
                            <td>User</td>
                            <td>{{ $flag->user->email }}</td>
                        @elseif(isset($flag->event))
                            <td>Event</td>
                            <td>{{ $flag->event->name }}</td>
                        @endif
                        <td>{{ $flag->level }}</td>
                        <td>{{ $flag->submitter->name }}</td>
                        <td>{{ $flag->created_at }}</td>

                        @if($flag->resolved)
                            <td>Resolved</td>
                        @else
                            <td>Unresolved</td>
                        @endif
                        <td class="text-center col-md-1">
                            <a class="btn btn-small btn-success" href="{{ URL::to('archive_flags/' . $flag->id) }}">View</a>
                        </td>
                        <td class="text-center ">
                            <button type="button" class="btn btn-sm btn-primary report addReport" name="{{$flag->id}}">Restore</button>
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
        $('#FlagsTable').DataTable();

        $('#FlagsTable').on('click', '.report', function(){
            var button = $(this);
            var index = button.attr("name");
            var remove = $(this).hasClass("removeReport");
            var add = $(this).hasClass("addReport");
                    <?php
                    $flagNames = array('empty');
                    foreach($flags as $flag)
                    {
                        $flagNames[$flag->id] = $flag->name;
                    }
                    ?>
            var flagNames = <?php echo json_encode($flagNames); ?>;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            if (add) {
                $.ajax({

                    type: "GET",
                    url: 'archive_flags/restore/' + $(this).attr("name"),
                    dataType: 'json',
                    success: function (data) {
                        //alerts users to successful button pushing.
                        /*html = '<div class="alert alert-success">' + flagNames[index] + ' restored to flag page!<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>';
                        $('#successOrFailure').html(html);*/
                        toastr["success"]( "Flag was successfully restored to flags", "Flag Restored");

                        button.css({"background-color": "#FFC72C", "color": "#041E42", "border-color": "#FFC72C"});
                        button.addClass('disabled').removeClass('addReport');
                        button.text(function (i, text) {
                            return "Flag Restored";
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