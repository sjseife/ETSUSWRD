@extends('layouts.dataTables')

@section('content')
    <style>
        .table-bordered{
            border-bottom: solid 3px  #041E42!important;
        }
    </style>
    <div class="text-center"><h1 class="page-header">All Contacts</h1></div>

    <div class="container">
        <!-- create a new contact (uses the create method found at GET /contact/create -->
        <a class="btn btn-small btn-primary pull-right" href="{{ URL::to('contacts/create') }}" style="margin-bottom: 20px;">Create New Contact</a>
        <br />
        <br />
        <div class="row">
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%"id="ContactTable">
                <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>View</th>
                </tr>
                </thead>
                <tbody>
                @foreach($contacts as $key => $contact)
                    <?php $link = false; ?>
                    <tr>
                        <td>
                            {{ $contact->firstName }}
                            <?php
                            $count = 0;
                            foreach ($contact->flags as $key=>$value) {
                                if ($value ['resolved'] == '0') {
                                    $count++;
                                }
                            }
                            if($count != 0)
                            {
                            ?>
                            <a class="btn btn-xs btn-danger" style="border-radius: 12px;" href="{{ URL::to('contacts/' . $contact->id) }}">{{ $count }}</a>
                            <?php
                            }
                            ?>
                        </td>
                        <td>{{ $contact->lastName }}</td>
                        <td>{{ $contact->protectedEmail }}</td>
                        <td>
                            <?php
                                if(!function_exists('phoneFormat')){
                                    include (public_path() . '/php/functions.php');
                                }
                                echo phoneFormat($contact->protectedPhoneNumber);
                            ?>
                        </td>
                        <td class="text-center">

                            <!-- show the contact (uses the show method found at GET /contacts/{id} -->
                            <a class="btn btn-small btn-success" href="{{ URL::to('contacts/' . $contact->id) }}">View</a>

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
        $('#ContactTable').DataTable();
    });
</script>
@endpush