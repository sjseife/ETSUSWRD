@extends('layouts.general')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">View User</div>
                <div class="panel-body">
                    <a href="{{ '/resources' }}" class="btn btn-default">Back</a>

                    <div class="col-md-offset-2"><br/><br/>
                        <div>
                        </div>
                    </div>
                    <dl class="dl-horizontal">
                        <dt>Name</dt>
                        <dd>{{ $user->name }}</dd>
                        <dt>Email</dt>
                        <dd>{{ $user->email }}</dd>
                        <dt>Role</dt>
                        <dd>{{ $user->role }}</dd>
                        <dt>Reported Problems</dt>
                        @if(isset($user->flags))
                            @foreach($user->flags as $flag)
                                @if(!$flag->resolved)
                                    <dd>{{ $flag->comments }}</dd>
                                @endif
                            @endforeach
                        @else
                            <dd>No problems reported</dd>
                        @endif
                    </dl>
                    <div class="col-md-offset-2">
                        <br/>
                        <br/>
                        <!-- Flag this user as incorrect -->
                        <a class="btn btn-lg btn-link" href="{{ URL::to('users/' . $user->id. '/flag') }}">Report a problem with this user.</a>
                        <br/>
                        <br/>
                        <div class="col-md-offset-2">
                        <!-- edit this contact (uses the edit method found at GET /contact/{id}/edit -->
                        <a class="btn btn-lg btn-info" href="{{ URL::to('users/' . $user->id. '/edit') }}">Edit</a>
                        <!-- delete the resource -->
                        <!-- Trigger the modal with a button -->
                        <button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#deleteModal">Delete</button>
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