@extends('layouts.general')
@section('content')
    <!--suppress ALL -->
    <div class="container">
        <div id="form-success"></div>
        <h1>Roles</h1>
    </div>

    <hr/>

    {!! Form::open(array('class'=>'form-horizontal', 'url' => 'roles', 'name' => 'roles')) !!}
        <div class="form-group">
            <div class="col-md-12 centered-div"><br><br>
                @if(isset($roles))
                    <div class="form-group" style="margin-left: 17%"><b>Permissions</b></div>
                    @foreach($roles as $role)
                        <div class="form-inline role">
                            <div class="form-group">
                                <table style="border: none;">
                                    <tr>
                                    </tr>
                                    <tr>
                                        <td>
                                            {!! Form::text('role['.$role->id.']', $role->name, ['class'=>'form-control input-md']) !!}
                                        </td>
                                        <td class="padsome">
                                            <p id="rolepermissions"></p>
                                            @if($role->base == '1') <img src="{{ asset('images\check_mark.png') }}"> Base @endif
                                            @if($role->extended == '1') <img src="{{ asset('images\check_mark.png') }}"> Extended @endif
                                            @if($role->create_update == '1') <img src="{{ asset('images\check_mark.png') }}"> Create/Update @endif
                                            @if($role->delete == '1') <img src="{{ asset('images\check_mark.png') }}"> Delete @endif
                                            @if($role->archive == '1') <img src="{{ asset('images\check_mark.png') }}"> Archive @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="range" name="range[{{ $role->id }}]" class="rangeInput" min="0" max="7" value="{{ $rolePermissions[$role->id] }}" onchange="updateSilder(this.value)" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <button type=button class="btn btn-link btn-small removeRole">Remove</button>
                                        </td>
                                    </tr>
                                </table>
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
            var new_add2 = '<div class="form-inline role">' +
                    '<div class="form-group">' +
                    '<input class="form-control input-md" name="role[]" type="text" value="New Role">'+
                    '<input type="range" name="range[]" class="rangeInput" min="0" max="7" value="0" />'+
                    '<button type=button class="btn btn-link btn-small addedRemoveRole">Remove</button>'+
                    '</div>'+
                    '</div>';
            var new_add = '<div class="form-inline role">' +
                    '<div class="form-group">' +
                    '<table style="border: none;">' +
                    '<tr>' +
                    '<td>' +
                    '<input class="form-control input-md" name="role[]" type="text" value="New Role">' +
                    '</td>' +
                    '<td class="padsome">' +
                    'Testing...' +
                    '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>' +
                    '<input type="range" name="range[]" class="rangeInput" min="0" max="7" value="0" onchange="updateSilder(this.value)" />' +
                    '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>' +
                    '<button type=button class="btn btn-link btn-small removeRole">Remove</button>' +
                    '</td>' +
                    '</tr>' +
                    '</table>' +
                    '</div>' +
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

    //detect value change on slider
    function updateSilder(valueIn) {
        //update visual permission levels
        console.log("Moved!");
        document.getElementById("rolepermissions").innerHTML =
                "Test!!!!!!!!";
    }
</script>
@endpush