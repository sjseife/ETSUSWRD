<nav class="navbar navbar-default navbar-static-top" style="background-color:#041E42; height:70px">
    <div class="container">
        <div class="navbar-header">
            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="/images/header_logo_2014.png" style="width:190px;">
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                @if (Auth::user()->role->base == '1')
                    <li><a href="{{ url('/events') }}">Events</a></li>
                    <li><a href="{{ url('/resources') }}">Resources</a></li>
                    <li><a href="{{ url('/worklist/generateReport') }}">Work List</a></li>
                @endif
                @if (Auth::user()->role->extended == '1')
                    <li><a href="{{ url('/contacts') }}">Contacts</a></li>
                    <li><a href="{{ url('/categories') }}">Categories</a></li>
                    <li><a href="{{ url('/flags') }}">Flags <span class="badge badge-danger" id="flagCount"></span></a></li>
                @endif
                @if (Auth::user()->role->users == '1')
                    <li><a href="{{ url('/users') }}">Users</a></li>
                @endif
                @if (Auth::user()->role->archive == '1')
                    <li><a href="{{ url('/archive') }}">Archive</a></li>
                @endif
                @if (Auth::user()->role->roles == '1')
                    <li><a href="{{ url('/roles') }}">Roles</a></li>
                @endif


            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>

        </div>
    </div>
</nav>

@push('scripts')

    @if(Auth::user()->role->extended == '1')
        <script>
            $(document).ready(function(){
                var worker = function(){
                    $.ajax({
                        type: "GET",
                        url: 'flags/count',
                        dataType: 'json',
                        success: function (data) {
                            console.log(data);
                            if(data == 0) {
                                $("#flagCount").text("");
                            }
                            else{
                                $("#flagCount").text(data);
                            }
                        },
                        complete: function() {
                            // Schedule the next request when the current one's complete
                            setTimeout(worker, 5000);
                        }
                    });
                };

                worker();
            });
        </script>
    @endif

@endpush