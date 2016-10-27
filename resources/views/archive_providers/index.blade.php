@extends('layouts.dataTables')

@section('content')
    <div class="text-center"><h1 class="page-header">All Providers</h1></div>
    <div class="container">
    @if (Auth::user()->role == 'GA' || Auth::user()->role == 'Admin')
        <!-- create a new provider (uses the create method found at GET /providers/create -->
        <a class="btn btn-md btn-primary pull-right" href="{{ URL::to('providers/create') }}" style="margin-bottom: 20px;">Create New Provider</a>
        @endif
        <br />
        <br />
        <div class="row">
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%"id="ProviderTable">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Website</th>
                    <th>View</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($providers as $key => $provider)
                    <?php $link = false; ?>
                    <tr>
                        <td>{{ $provider->name }}</td>
                        <td><?php
                            $tempPhoneNumber = $provider->publicPhoneNumber;
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
                        <td>{{ $provider->publicEmail }}</td>
                        <td><a href="http://{{ $provider->website }}">{{ $provider->website }}</a></td>
                        <td class="text-center">

                            <!-- show the contact (uses the show method found at GET /contacts/{id} -->
                            <a class="btn btn-sm btn-success" href="{{ URL::to('archive_providers/' . $provider->id) }}">View</a>

                        </td>
                        <td class="text-center ">


                            <!-- show the event (uses the show method found at GET /event/view/{id} -->
                            {{--<a class="btn btn-sm btn-success" href="{{ URL::to('events/' . $event->id) }}">View</a>--}}
                            <button type="button" class="btn btn-sm btn-primary report
                                addReport" name="{{$provider->id}}">Restore</button>
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
    $(document).ready(function() {
        $('#ProviderTable').DataTable();
        
        $(".report").click(function (){
            var button = $(this);
            var index = button.attr("name");
            var remove = $(this).hasClass("removeReport");
            var add = $(this).hasClass("addReport");
                    <?php
                    $providerNames = array('empty');
                    foreach($providers as $provider)
                    {
                        $providerNames[$provider->id] = $provider->name;
                    }
                    ?>
            var providerNames = <?php echo json_encode($providerNames); ?>;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            if (add) {
                $.ajax({

                    type: "GET",
                    url: 'archive_providers/restore/' + $(this).attr("name"),
                    dataType: 'json',
                    success: function (data) {
                        //alerts users to successful button pushing.
                        html = '<div class="alert alert-success">' + providerNames[index] + ' restored to provider page!<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>';
                        $('#successOrFailure').html(html);
                        button.css({"background-color": "#FFC72C", "color": "#041E42", "border-color": "#FFC72C"});
                        button.addClass('disabled').removeClass('addReport');
                        button.text(function (i, text) {
                            return "Provider Restored";
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
            else if (remove) {
                $.ajax({

                    type: "GET",
                    url: 'providers/removeReport/' + $(this).attr("name"),
                    dataType: 'json',
                    success: function (data) {
                        //alerts users to successful button pushing.
                        html = '<div class="alert alert-danger">' + providerNames[index] + ' Removed from Report!<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>';
                        $('#successOrFailure').html(html);
                        button.css({"background-color": "#337ab7", "color": "white", "border-color": "#2e6da4"});
                        button.addClass('addReport').removeClass('removeReport');
                        button.text(function (i, text) {
                            return "Add Provider";
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