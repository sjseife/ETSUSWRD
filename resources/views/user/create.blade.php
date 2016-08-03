@extends('layouts.dashboard')

@section('content')
    <div class="content">
        <form class="form-horizontal" method="post" action="{{ action('UserController@createUser') }}" accept-charset="UTF-8">
            {{ csrf_field() }}
            <div class="form-group">
                <label class="col-md-2 control-label" for="Name">Name</label>
                <div class="col-md-4">
                    <input id="name" name="name" type="text" placeholder="Jon" class="form-control input-md">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label" for="email">Email</label>
                <div class="col-md-4">
                    <input id="email" name="email" type="text" placeholder="abc@123.com" class="form-control input-md">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label" for="password">Password</label>
                <div class="col-md-4">
                    <input name="password" type="password"  class="form-control input-md">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label" for="Role">Role</label>
                <div class="col-md-4">
                    <select id="role" name="role" class="form-control input-md">
                        <option value="User">User</option>
                        <option value="GA">GA</option>
                        <option value="Admin">Admin</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </div>

        </form>
    </div>
@endsection