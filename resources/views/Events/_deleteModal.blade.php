<div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete Confirm</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you wish to delete this event?</p>
            </div>
            <div class="modal-footer">
                {{ Form::open(['method' => 'DELETE', 'url' => 'events/' . $event->id]) }}
                {{ Form::hidden('id', $event->id) }}
                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                {{ Form::close() }}
            </div>
        </div>

    </div>
</div>