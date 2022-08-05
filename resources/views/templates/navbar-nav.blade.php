<ul class="navbar-nav nav-pills ms-auto mb-2 mb-lg-0">
    <li class="nav-item">
        <x-nav-link name="Home" url="{{ route('page.index') }}" />
    </li>

    @auth
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('home') }}">Home</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
    @else
        <li class="nav-item">
            <x-nav-link name="Login" url="{{ route('login') }}" />

        </li>
        <li class="nav-item">
            <x-nav-link name="Register" url="{{ route('register') }}" />

        </li>
    @endauth

</ul>
