@extends('layouts.general')
@section('content')
    <!-- Trigger the modal with a button -->
    <button type="button" class="btn btn-warning btn-md" data-toggle="modal" data-target="#createRoleModal">New Role</button>
    <!--suppress ALL -->
    <div class="container">
        <div id="form-success"></div>
        <h1>Roles</h1>
    </div>
    <h3>Explanation of Permissions:</h3>
    <p>
        <strong>Base:</strong> The bare bones requirement to use the site. Includes viewing Events, Resources, and creating PDF Reports. This permission allows for the creation of flags.<br />
        <strong>Extended:</strong> Allows viewing of Contacts, Categories, and Flags. <br />
        <strong>Create/Update:</strong> Allows for the creation and editing of Events, Resources, Contacts, and Categories. Additionally allows for the resolution of appropriate flags.<br />
        <strong>Delete:</strong> Allows for the deleting (archiving) of Events, Resources, Contacts, and Categories. Additionally allows for the resolution of appropriate flags.<br />
        <strong>Archive:</strong> Allows for access of the archive.<br />
        <strong>Users:</strong> Allows for the creating, editing, and deleting of users.<br />
        <strong>Roles:</strong> Allows for the creation, editing, and deleting of user roles.<br />
    </p>
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
                                            <!-- Javascript updates role permissions -->
                                            <span id="rolepermissions{{$role->id}}"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="range" name="range[{{ $role->id }}]" class="rangeInput" min="0" max="7" value="{{ $rolePermissions[$role->id] }}" onchange="updateSilder({{ $role->id }}, this.value)" />
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
                <button type="button" class="btn btn-warning btn-md" data-toggle="modal" data-target="#createRoleModal" id="newRole">New Role</button>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                {!! Form::submit('Save', ['class' => 'btn btn-primary', 'name' => 'resource']) !!}
                <a href="{{ url('/resources') }}" class="btn btn-danger"  style="margin-left:10%">Cancel</a>

            </div>
        </div>
    {!! Form::close() !!}

    @include('roles._createForm')
    {{--If user does not enter required field.--}}
    @include('errors.list')
@stop
@push('scripts')
<script>
    $(document).ready(function() {

        var rolesArray = {!! json_encode($roles->toArray()) !!};
        var rolePermissionsArray = {!! json_encode($rolePermissions) !!};
        rolesArray.forEach(function(role){
            updateSilder(role.id, rolePermissionsArray[role.id]);
        });

        /*$( "#newRole" ).click(function() {
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
                    '<span id="rolepermissions"></span>' +
                    '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>' +
                    '<input type="range" name="range[]" class="rangeInput" min="0" max="7" value="0" onchange="updateSilder(this.value)" />' +
                    '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>' +
                    '<button type=button class="btn btn-link btn-small addedRemoveRole">Remove</button>' +
                    '</td>' +
                    '</tr>' +
                    '</table>' +
                    '</div>' +
                    '</div>';
            $(this).before(new_add);

            $( ".addedRemoveRole" ).click(function() {
                $(this).closest('.role').remove();
            });
        });*/

        $( ".removeRole" ).click(function() {
            $(this).closest('.role').remove();
        });
    });

    //detect value change on slider
    function updateSilder(roleIdIn, valueIn) {
        var rolesArray = {!! json_encode($roles->toArray()) !!};

        rolesArray.forEach(function(role){
            var output = '';
            if(role.id = roleIdIn){
                if(valueIn >= 1){
                    output += '<img src="images/check_mark.png"> Base ';
                }
                if(valueIn > 1){
                    output += '<img src="images/check_mark.png"> Extended ';
                }
                if(valueIn > 2){
                    output += '<img src="images/check_mark.png"> Create/Update ';
                }
                if(valueIn > 3){
                    output += '<img src="images/check_mark.png"> Delete ';
                }
                if(valueIn > 4){
                    output += '<img src="images/check_mark.png"> Archive ';
                }
                if(valueIn > 5){
                    output += '<img src="images/check_mark.png"> Users ';
                }
                if(valueIn > 6){
                    output += '<img src="images/check_mark.png"> Roles ';
                }
                document.getElementById("rolepermissions"+role.id).innerHTML = output;
            }
        });
    }
</script>
@endpush