@extends('layouts.dataTables')
@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-primary">
                <div class="panel-heading">View User</div>
                <div class="panel-body ">
                    <a href="{{ url('/users') }}" class="btn btn-default">Back</a>
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

                        <!-- edit this contact (uses the edit method found at GET /resource/edit/{id} -->
                            <a class="btn btn-md btn-info" href="{{ URL::to('users/' . $user->id. '/edit') }}">Edit</a> |
                            <!-- delete the contact -->
                            <!-- Trigger the modal with a button -->
                            <button type="button" class="btn btn-warning btn-md" data-toggle="modal" data-target="#deleteModal">Delete</button>

                        <br/>
                        <br/>
                    </div>
                    <br/>
                    <br/>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    @include('users._deleteModal')
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
</script>
@endpush