<nav class="navbar navbar-default navbar-static-top navbar-expand-lg navbar-light bg-light">


    <div class="container">
        <div class="navbar-header">
            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/admin') }}">
                <img style="width:70px;heigh:30px" src="https://uet.vnu.edu.vn/wp-content/uploads/2019/03/logo-outline.png">
            </a>
        </div>

        <div class="collapse navbar-collapse my-2 my-sm-0 position-relative" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->

            @if (auth('admin')->user())
                @include('components.managerNav')
            @endif
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav position-absolute" style="right: 0;">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">Login</a></li>
                @elseif (auth('admin')->user())
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->last_name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('admin.logout') }}" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>