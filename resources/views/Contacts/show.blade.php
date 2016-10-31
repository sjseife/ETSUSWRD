@extends('layouts.dataTables')
@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">View Contact</div>
                <div class="panel-body ">
                    <a href="{{ '/contacts' }}" class="btn btn-default">Back</a>
                    <h2><em>{{ $contact->firstName}}&nbsp; {{$contact->lastName }}</em></h2>
                    <div class="col-md-4">
                        <p><b>Email:</b></p>
                        {{ $contact->protectedEmail }}
                    </div>
                    <div class="col-md-4">
                        <p><b>Phone Number:</b></p>
                        {{ $contact->protectedPhoneNumber }}
                    </div>
                    <div class="col-md-4">
                        <p><strong>Providers:</strong></p>
                        @if(!$contact->providers->isEmpty())
                            @foreach($contact->providers as $provider)
                                <p>
                                    <a href="{{ URL::to('providers/' . $provider->id) }}">
                                        {{ $provider->name }}
                                    </a>
                                </p>
                            @endforeach
                        @else
                            <p>N/A</p>
                        @endif
                    </div>
                    <div class="col-md-10">
                        <hr/>
                    </div>
                    <div class="col-md-10">
                        <p><b>Reported Problems:</b></p>
                        @if(!$contact->flags->isEmpty())
                            @foreach($contact->flags as $flag)
                                @if(!$flag->resolved)
                                    <p>{{ $flag->comments }}</p>
                                @endif
                            @endforeach
                        @else
                            <p>No problems reported</p>
                        @endif
                    </div>
                    <div class="col-md-10">
                        <hr/>
                    </div>
                    <div class="col-md-10 col-md-offset-4">
                        <br/>
                        @if (Auth::user()->role == 'GA' || Auth::user()->role == 'Admin')
                        <!-- edit this contact (uses the edit method found at GET /resource/edit/{id} -->
                            <a class="btn btn-md btn-info" href="{{ URL::to('contacts/' . $contact->id. '/edit') }}">Edit</a> |
                            <!-- delete the contact -->
                            <!-- Trigger the modal with a button -->
                            <button type="button" class="btn btn-warning btn-md" data-toggle="modal" data-target="#deleteModal">Delete</button>
                        @endif
                        <br/>
                        <br/>
                        <div class=""><br/><br/>
                            <div>
                                <!-- Flag this contact as incorrect -->
                                <a  href="{{ URL::to('contacts/' . $contact->id. '/flag') }}" class="btn btn-danger">Report a problem with this contact.</a>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <br/>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    @include('contacts._deleteModal')
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