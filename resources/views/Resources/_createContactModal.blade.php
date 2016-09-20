<div id="createContactModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Create New Contact</h4>
            </div>
            <div class="modal-body">
                <p>Note that you will not be able to select the resource you are currently creating.</p>
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
                data:$('#firstName, #lastName, #email, #phoneNumber, #resource_list').serialize(),
                dataType: 'json',
                success: function(data){
                    //alerts users to successful creation of contact.
                    html = '<div class="alert alert-success"><ul><li>Contact created succesfully!</li></ul></div>';
                    $( '#form-success').html( html );

                    //Automatically add new contact to select box, and select them
                    var newOption = new Option(data.firstName + ' ' + data.lastName, data.id, false, true);
                    $("#contact_list").append(newOption).trigger('change');

                    //Finally, Reset new contact form and close modal

                    $('#firstName').val("");
                    $('#lastName').val("");
                    $('#email').val("");
                    $('#phoneNumber').val("");
                    $('#resource_list > option').each(function(){
                       $(this).removeAttr("selected");
                    });

                    $('#resource_list').trigger('change');
                    $('#createContactModal').modal('toggle');

                    //Here lies fallen Javascript attempts. RIP buddies. RIP.

                    //document.getElementById('contact').reset();

                    //$('#contact')[0].reset();

                    //$('#contact').trigger('reset');

                    //$('#resource_list option').prop("selected", false);

                    /*$(':input', '#contact') //all input tags in the contact form
                            .not(':button, :submit, :reset, :hidden') //deselecting these. They stay the same
                            .removeAttr('checked')  //uncheck everything (currently useless, but just in case this form changes)
                            .removeAttr('selected') //deselect any selected options
                            .not('‌​:checkbox, :radio, select') //more deselecting. don't want to wipe all of our select options
                            .val(''); //clearing the values from the remaining inputs.*/


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
            })
        })
    });
</script>
@endpush