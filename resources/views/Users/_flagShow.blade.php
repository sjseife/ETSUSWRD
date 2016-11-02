<h2><em> {{ $user->name }}</em></h2>
<div class="col-md-4">
    <p><b>Email:</b></p>
    {{ $user->email }}
</div>
<div class="col-md-4">
    <p><b>Role:</b></p>
    {{ $user->role }}
</div>
<div class="col-md-10 col-md-offset-4">
    <br/>
@if (Auth::user()->role == 'GA' || Auth::user()->role == 'Admin')
    <!-- edit this contact (uses the edit method found at GET /resource/edit/{id} -->
        <a class="btn btn-md btn-info" href="{{ URL::to('users/' . $user->id. '/edit') }}">Edit</a> |
        <!-- delete the contact -->
        <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-warning btn-md" data-toggle="modal" data-target="#deleteModal">Delete</button>
    @endif
    <br/>
</div>
@include('users._deleteModal')