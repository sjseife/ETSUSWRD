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
    $(document).ready(function() {
        $('#ContactTable').DataTable();
    });
</script>
@endpush