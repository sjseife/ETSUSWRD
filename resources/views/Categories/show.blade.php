@extends('layouts.general')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">View Category</div>
                <div class="panel-body">
                    <a href="{{ url('/categories') }}" class="btn btn-default">Back</a>

                    <div class="col-md-offset-1"><br/><br/>
                        <div>

                        </div>
                    </div>
                    <dl class="dl-horizontal">
                        <dt><h2>{{ $category->name }}</h2></dt>

                        <dd></dd>
                        <dt>Resources</dt>
                        @foreach($category->resources as $resource)
                            <dd>
                                <a href="{{ URL::to('resources/' . $resource->id) }}">
                                    {{ $resource->name }}
                                </a>
                            </dd>
                        @endforeach
                        <dt>Events</dt>
                        @foreach($category->events as $event)
                            <dd>
                                <a href="{{ URL::to('events/' . $event->id) }}">
                                    {{ $event->name }}
                                </a>
                            </dd>
                        @endforeach
                    </dl>
                    <div class="col-md-offset-4">
                        <br/>
                        <!-- edit this contact (uses the edit method found at GET /category/{id}/edit -->
                        <a class="btn btn-lg btn-info" href="{{ URL::to('categories/' . $category->id. '/edit') }}">Edit</a>
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

    <!-- Modal -->
    @include('categories._deleteModal')
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