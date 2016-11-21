<div id="createContactModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Create New Contact</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(array('class'=>'form-horizontal', 'name' => 'contact', 'id' => 'contact')) !!}
                @include('resources._createContactform')
                <div id="form-errors"></div>
            </div>

            <div class="modal-footer">
                {!! Form::reset('Clear Form') !!}
                <button type="button" class="btn btn-primary", name="contactSubmit", id="contactSubmit">Create Contact</button>
                {!! Form::close() !!}
            </div>
        </div>

    </div>
</div>

@push('scripts')
<script>
    $(function(){
        $("#contactSubmit").click(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:"POST",
                url:'/contactsJSON',
                data:$('#firstName, #lastName, #email, #phoneNumber').serialize(),
                dataType: 'json',
                success: function(data){
                    //alerts users to successful creation of contact.
                    /*html = '<div class="alert alert-success"><ul><li>Contact created succesfully!</li></ul></div>';
                    $( '#form-success').html( html );*/

                    //Automatically add new contact to select box, and select them
                    var newOption = new Option(data.firstName + ' ' + data.lastName, data.id, false, true);
                    $("#contact_list").append(newOption).trigger('change');

                    //Finally, Reset new contact form and close modal

                    $('#firstName').val("");
                    $('#lastName').val("");
                    $('#email').val("");
                    $('#phoneNumber').val("");

                    $('#createContactModal').modal('toggle');


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