@extends('layouts.app')


@section('content')

    <div class="content">
        <form class="form-horizontal" method="POST" action="/user/{{$id->id}}">
            {{ method_field('PATCH') }}
            {{ csrf_field() }}
            <div class="form-group">
                <label class="col-md-2 control-label" for="name">Name</label>
                <div class="col-md-4">
                    <input id="name" name="name" type="text" class="form-control input-md" value="{{ $id->name }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="email">Email</label>
                <div class="col-md-4">
                    <input id="email" name="email" type="text" class="form-control input-md" value="{{ $id->email }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="role">Role</label>
                <div class="col-md-4">
                    <select id="role" name="role" class="form-control">
                        <?php
                        $roles = array('Admin', 'GA', 'User');
                        $role = $id['role'] ;

                        foreach($roles as $r)
                        {
                            $string = $string = '<option value="'.$r.'"';
                            if($r == $role)
                            {
                                $string .= ' selected';
                            }
                            $string .= '>'.$r.'</option>';
                            echo $string;
                        }

                        ?>



                    </select>
                </div>
            </div>
            <div class="col-md-5 text-center">
                <input class="btn btn-primary" type="submit" value="Update">
                <a class="btn btn-small btn-info" href="{{'/users'}}">Go Back to Users Page</a>
            </div>
        </form>
    </div>
@endsection