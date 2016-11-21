<div id="createRoleModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Create New Role</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(array('class'=>'form-horizontal', 'name' => 'role', 'id' => 'role')) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Name:', ['class'=>'col-md-2 control-label']) !!}
                    <div class="col-md-4">
                        {!! Form::text('name', null, ['class'=>'form-control input-md', 'id' => 'name']) !!}
                    </div>
                </div>
                <div id="form-errors"></div>
            </div>

            <div class="modal-footer">
                {!! Form::reset('Clear Form') !!}
                <button type="button" class="btn btn-primary", name="roleSubmit", id="roleSubmit">Create Role</button>
                {!! Form::close() !!}
            </div>
        </div>

    </div>
</div>

@push('scripts')
<script>
    $(function(){
        $("#roleSubmit").click(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:"POST",
                url:'/roles/createNew',
                data:$('#name').serialize(),
                dataType: 'json',
                success: function(data){
                    console.log(data.id);

                    /*//alerts users to successful creation of role.
                    html = '<div class="alert alert-success"><ul><li>role created succesfully!</li></ul></div>';
                    $( '#form-success').html( html );

                    //Automatically add new role to select box, and select them
                    var newOption = new Option(data.firstName + ' ' + data.lastName, data.id, false, true);
                    $("#role_list").append(newOption).trigger('change');

                    //Finally, Reset new role form and close modal

                    $('#name').val("");

                    $('#createRoleModal').modal('toggle');*/


                },
                error :function( data ) {
                    if( data.status === 401 ) //redirect if not authenticated user.
                        $( location ).prop( 'pathname', 'auth/login' );
                    if( data.status === 422 ) {
                        //process validation errors here.
                        var errors = data.responseJSON; //this will get the errors response data.
                        //show them somewhere in the modal
                        errorsHtml = '<div class="alert alert-danger"><ul>';

                        $.each( errors , function( key, value ) {
                            errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
                        });
                        errorsHtml += '</ul></di>';

                        $( '#form-errors' ).html( errorsHtml ); //appending to a <div id="form-errors"></div> inside form
                    } else {
                        html = '<div class="alert alert-danger"><ul><li>There was a problem processing your request. ' +
                            'Please try again later.</li></ul></div>';
                        $( '#form-errors' ).html( html ); //appending to a <div id="form-errors"></div> inside form
                    }
                }
            });
        });
    });
</script>
@endpush