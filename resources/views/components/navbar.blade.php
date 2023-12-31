<nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name', 'Point of Sale') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link @if (Route::currentRouteName() == 'home') active @endif" href="{{ route('home') }}">
                        Home
                    </a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                @endauth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle @if (in_array(Route::currentRouteName(), ['about', 'contact', 'license'])) active @endif" href="#"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Support
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item @if (Route::currentRouteName() == 'about') active @endif"
                                href="{{ route('about') }}">
                                About Us
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item @if (Route::currentRouteName() == 'contact') active @endif"
                                href="{{ route('contact') }}">
                                Contact Us
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item @if (Route::currentRouteName() == 'license') active @endif"
                                href="{{ route('license') }}">
                                License
                            </a>
                        </li>
                    </ul>
                </li>
                @guest
                    <li class="nav-item">
                        <a class="nav-link @if (Route::currentRouteName() == 'login') active @endif" href="{{ route('login') }}">
                            Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Route::currentRouteName() == 'register') active @endif" href="{{ route('register') }}">
                            Register
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
