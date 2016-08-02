@if ($errors->any())
    <ul class="alert alert-danger col-md-4 col-md-offset-2">
        @foreach ($errors->all() as $error)
            <li class="col-md-offset-1">{{ $error }}</li>
        @endforeach
    </ul>
@endif