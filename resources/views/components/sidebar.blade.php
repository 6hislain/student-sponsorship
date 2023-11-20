<div class='sidebar bg-body min-vh-100 d-none d-sm-block' data-bs-theme="dark">
    <div class='d-flex flex-column justify-content-between h-100'>
        <div>
            <div class='text-center'>
                <img class='m-3' alt='logo' src='/img/logo.png' height='75' width='200' />
            </div>
            <div class="list-group list-group-flush">
                <a href="{{ route('home') }}" class="list-group-item list-group-item-action">
                    <i class='bi bi-house me-2'></i> Home
                </a>
                <a href="{{ route('dashboard') }}"
                    class="list-group-item list-group-item-action @if (Route::currentRouteName() == 'dashboard') active @endif">
                    <i class='bi bi-speedometer2 me-2'></i> Dashboard
                </a>
                <a href="{{ route('child.index') }}"
                    class="list-group-item list-group-item-action @if (str_contains(Route::currentRouteName(), 'child')) active @endif">
                    <i class='bi bi-collection me-2'></i> Children
                </a>
                <a href="{{ route('sponsor.index') }}"
                    class="list-group-item list-group-item-action @if (str_contains(Route::currentRouteName(), 'sponsor')) active @endif">
                    <i class='bi bi-person-check me-2'></i> Sponsor
                </a>
                <a href="{{ route('payment.index') }}"
                    class="list-group-item list-group-item-action @if (str_contains(Route::currentRouteName(), 'payment')) active @endif">
                    <i class='bi bi-box me-2'></i> Payment
                </a>
                <a href="{{ route('update.index') }}"
                    class="list-group-item list-group-item-action @if (str_contains(Route::currentRouteName(), 'update')) active @endif">
                    <i class='bi bi-arrow-down-up me-2'></i> Update
                </a>
                <a href="{{ route('application.index') }}"
                    class="list-group-item list-group-item-action @if (str_contains(Route::currentRouteName(), 'application')) active @endif">
                    <i class='bi bi-arrow-down-up me-2'></i> Application
                </a>
                <a href="{{ route('user.index') }}"
                    class="list-group-item list-group-item-action @if (str_contains(Route::currentRouteName(), 'user')) active @endif">
                    <i class='bi bi-people me-2'></i> User
                </a>
                <a href="{{ route('user.index') }}" class="list-group-item list-group-item-action">
                    <i class='bi bi-person-circle me-2'></i> Profile
                </a>
                <a href="{{ route('logout') }}" class="list-group-item list-group-item-action">
                    <i class='bi bi-box-arrow-left me-2'></i> Logout
                </a>
            </div>
        </div>
        <div class='d-flex flex-row'>
            <img class='m-3 rounded-pill' alt='{{ Auth::user()->name }}' src='/img/user.png' height='50'
                width='50' />
            <div class='text-white my-auto'>
                <b class='d-block'>{{ Auth::user()->name }}</b>
                <small class='d-block'>{{ Auth::user()->role }}</small>
            </div>
        </div>
    </div>
</div>
