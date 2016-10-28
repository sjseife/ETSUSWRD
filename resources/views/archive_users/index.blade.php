@extends('layouts.dataTables')

@section('content')
    <div class="text-center"><h1 class="page-header">All Archived Users</h1></div>
    <div class="container">
        <div class="row">
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" id="UsersTable">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>User Since</th>
                    <th></th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $key => $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td class="text-center">

                            <!-- show the user (uses the show method found at GET /users/{id} -->
                            <a class="btn btn-small btn-success" href="{{ URL::to('archive_users/' . $user->id) }}">View</a>

                        </td>
                        <td class="text-center ">
                            <button type="button" class="btn btn-sm btn-primary report addReport" name="{{$user->id}}">Restore</button>
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
        $('#UserTable').DataTable();
        
        $(".report").click(function (){
            var button = $(this);
            var index = button.attr("name");
            var remove = $(this).hasClass("removeReport");
            var add = $(this).hasClass("addReport");
                    <?php
                    $userNames = array('empty');
                    foreach($users as $user)
                    {
                        $userNames[$user->id] = $user->name;
                    }
                    ?>
            var userNames = <?php echo json_encode($userNames); ?>;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            if (add) {
                $.ajax({

                    type: "GET",
                    url: 'archive_users/restore/' + $(this).attr("name"),
                    dataType: 'json',
                    success: function (data) {
                        //alerts users to successful button pushing.
                        toastr["success"]( userNames[index] + " successfully restored to users", "User Restored");
                        button.css({"background-color": "#FFC72C", "color": "#041E42", "border-color": "#FFC72C"});
                        button.addClass('disabled').removeClass('addReport');
                        button.text(function (i, text) {
                            return "User Restored";
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