@extends('layouts.general')
@section('content')
    <!--suppress ALL -->
    <div class="container">
        <div id="form-success"></div>
        <div class="text-center"><h1 class="page-header">Roles</h1></div>
    </div>

    </br>
    </br>
    </br>
    {!! Form::open(array('class'=>'form-horizontal', 'url' => 'roles', 'name' => 'roles')) !!}
            <div class="col-md-12 col-md-offset-2">
                @if(isset($roles))
                    <table style="border: none;" id="roleTable">
                        <tr>
                            <td></td>
                            <td align="center"><b>Permissions</b></td>
                            <td></td>
                        </tr>
                        <tr style="border-bottom: solid;">
                            <td><b>Name</b></td>
                            <td class="padsome"><img src="images/check_mark.png"> Base
                                <img src="images/check_mark.png"> Extended
                                <img src="images/check_mark.png"> Create/Update
                                <img src="images/check_mark.png"> Delete
                                <img src="images/check_mark.png"> Archive
                                <img src="images/check_mark.png"> Users
                                <img src="images/check_mark.png"> Roles
                            </td>
                            <td></td>
                        </tr>
                    @foreach($roles as $role)
                                        <tr>
                                            <td style="padding-right: 5px; padding-top: 5px;">
                                                {!! Form::text('role['.$role->id.']', $role->name, ['class'=>'form-control input-md']) !!}
                                            </td>
                                            <td class="padsome">
                                                <!-- Javascript updates role permissions -->
                                                <span id="rolepermissions{{$role->id}}"></span>
                                            </td>
                                            <td>
                                                <button type=button class="btn btn-link btn-small removeRole">Remove</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td style="padding: 0px 5px;">
                                                <input type="range" name="range[{{ $role->id }}]" class="rangeInput" min="0" max="7" value="{{ $rolePermissions[$role->id] }}" onchange="updateSlider({{ $role->id }}, this.value)" />
                                            </td>
                                            <td></td>
                                        </tr>
                    @endforeach
                    </table>
                @endif
                <button type="button" class="btn btn-link btn-md" data-toggle="modal" data-target="#createRoleModal" id="newRole">New Role</button>

            </div>
        <div class="form-group">
            <div class="col-md-12 col-md-offset-5">
                {!! Form::submit('Save', ['class' => 'btn btn-primary', 'name' => 'resource']) !!}
                <a href="{{ url('/resources') }}" class="btn btn-danger"  style="margin-left:10%">Cancel</a>

            </div>
        </div>
    {!! Form::close() !!}
    </br>
    <div class="col-md-10 col-md-offset-1">
        <hr/>
        <h3>Explanation of Permissions:</h3><br/>
        <p>
            <strong>Base:</strong> The bare bones requirement to use the site. Includes viewing Events, Resources, and creating PDF Reports. This permission allows for the creation of flags.<br /><br />
            <strong>Extended:</strong> Allows viewing of Contacts, Categories, and Flags. <br /><br />
            <strong>Create/Update:</strong> Allows for the creation and editing of Events, Resources, Contacts, and Categories. Additionally allows for the resolution of appropriate flags.<br /><br />
            <strong>Delete:</strong> Allows for the deleting (archiving) of Events, Resources, Contacts, and Categories. Additionally allows for the resolution of appropriate flags.<br /><br />
            <strong>Archive:</strong> Allows for access of the archive.<br /><br />
            <strong>Users:</strong> Allows for the viewing, creating, editing, and deleting of users.<br /><br />
            <strong>Roles:</strong> Allows for the viewing, creating, editing, and deleting of user roles.<br />
        </p>
        <hr/>
    </div>
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
            updateSlider(role.id, rolePermissionsArray[role.id]);
        });

        $( ".removeRole" ).click(function() {
            $( this ).parent().parent().next().remove();
            $( this ).parent().parent().remove();
        });
    });

    //detect value change on slider
    function updateSlider(roleIdIn, valueIn) {
        var rolesArray = {!! json_encode($roles->toArray()) !!};

        rolesArray.forEach(function(role){
            var output = '';
            if(role.id = roleIdIn){
                if(valueIn >= 1){
                    output += '<img src="{{ asset('images/check_mark.png') }}"> Base ';
                }
                if(valueIn > 1){
                    output += '<img src="{{ asset('images/check_mark.png') }}"> Extended ';
                }
                if(valueIn > 2){
                    output += '<img src="{{ asset('images/check_mark.png') }}"> Create/Update ';
                }
                if(valueIn > 3){
                    output += '<img src="{{ asset('images/check_mark.png') }}"> Delete ';
                }
                if(valueIn > 4){
                    output += '<img src="{{ asset('images/check_mark.png') }}"> Archive ';
                }
                if(valueIn > 5){
                    output += '<img src="{{ asset('images/check_mark.png') }}"> Users ';
                }
                if(valueIn > 6){
                    output += '<img src="{{ asset('images/check_mark.png') }}"> Roles ';
                }
                document.getElementById("rolepermissions"+role.id).innerHTML = output;
            }
        });
    }
</script>
@endpush