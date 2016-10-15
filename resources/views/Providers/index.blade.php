@extends('layouts.dataTables')

@section('content')
    <h1 class="text-center">All Providers</h1>
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
                            <a class="btn btn-small btn-success" href="{{ URL::to('providers/' . $provider->id) }}">View</a>

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
    });
</script>
@endpush