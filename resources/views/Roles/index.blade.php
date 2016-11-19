@extends('layouts.general')
@section('content')
    <div class="container">
        <div id="form-success"></div>
        <h1>Roles</h1>
    </div>

    <hr/>

    {!! Form::open(array('class'=>'form-horizontal', 'url' => 'roles', 'name' => 'roles')) !!}
        <div class="form-group">
            <div class="col-md-12 centered-div"><br><br>
                @if(isset($roles))
                    @foreach($roles as $role)
                        <div class="form-inline role">
                            <div class="form-group">
                                {!! Form::text('role['.$role->id.']', $role->name, ['class'=>'form-control input-md']) !!}
                                <input type="range" name="range[{{ $role->id }}]" class="rangeInput" min="0" max="7" value="{{ $rolePermissions[$role->id] }}" />
                                <button type=button class="btn btn-link btn-small removeRole">Remove</button>
                            </div>
                        </div>
                    @endforeach
                @endif
                <button type=button class="btn btn-link btn-small" id="newRole">New Role</button>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                {!! Form::submit('Save', ['class' => 'btn btn-primary', 'name' => 'resource']) !!}
                <a href="{{ url('/resources') }}" class="btn btn-danger"  style="margin-left:10%">Cancel</a>

            </div>
        </div>
    {!! Form::close() !!}

    {{--If user does not enter required field.--}}
    @include('errors.list')
@stop
@push('scripts')
<script>
    $(document).ready(function() {

        $( "#newRole" ).click(function() {
            var new_add = '<div class="form-inline role">' +
                    '<div class="form-group">' +
                    '<input class="form-control input-md" name="role[]" type="text" value="New Role">'+
                    '<input type="range" name="range[]" class="rangeInput" min="0" max="7" value="0" />'+
                    '<button type=button class="btn btn-link btn-small addedRemoveRole">Remove</button>'+
                    '</div>'+
                    '</div>';
            $(this).before(new_add);
            $( ".addedRemoveRole" ).click(function() {
                $(this).closest('.role').remove();
            });
        });

        $( ".removeRole" ).click(function() {
            $(this).closest('.role').remove();
        });
    });



</script>
@endpush