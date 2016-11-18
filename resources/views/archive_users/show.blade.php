@extends('layouts.dataTables')
@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-primary">
                <div class="panel-heading">View User</div>
                <div class="panel-body ">
                    <a href="{{ url('/archive_users') }}" class="btn btn-default">Back</a>
                    <h2><em> {{ $user->name }}</em></h2>
                    </br>
                    <div class="col-md-4 ">
                        <p><b>Email:</b></p>
                        {{ $user->email }}
                    </div>
                    <div class="col-md-4 col-md-offset-4">
                        <p><b>Role:</b></p>
                        {{ $user->role->name }}
                    </div>
                    <div class="col-md-12">
                        <hr/>
                    </div>
                    <div class="col-md-6 col-md-offset-3">
                        <br/>
                        @if(Auth::user()->role->delete == '1')

                            <!-- edit this event (uses the edit method found at GET /event/edit/{id} -->
                                <a class="btn btn-sm btn-info" href="{{ URL::to('archive_users/showrestore/' . $user->id) }}">Restore</a>
                                <a class="btn btn-sm btn-danger" href="{{ URL::to('archive_users') }}">Cancel</a>
                                <!-- delete the event -->
                                <!-- Trigger the modal with a button -->
                            @endif
                        <br/>
                        <br/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @include('users._deleteModal')
@endsection