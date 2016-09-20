<div id="resolveModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Resolve Confirm</h4>
            </div>
            <div class="modal-body">
                <p>Are you really ready to resolve this flag? This cannnot be undone, yet.</p>
            </div>
            <div class="modal-footer">
                {{ Form::open(['method' => 'POST', 'url' => 'flags/' . $flag->id .'/resolve']) }}
                {{ Form::hidden('id', $flag->id) }}
                {{ Form::submit('Resolve', ['class' => 'btn btn-success']) }}
                {{ Form::close() }}
            </div>
        </div>

    </div>
</div>