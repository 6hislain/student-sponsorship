<div class='sidebar bg-body min-vh-100 d-none d-sm-block' data-bs-theme="dark">
    <div class='d-flex flex-column justify-content-between h-100'>
        <div>
            <div class='text-center'>
                <img class='m-3 rounded-pill' alt='' src='https://placehold.co/100x100png' height='100'
                    width='100' />
            </div>
            <div class="list-group list-group-flush">
                <a href="{{ route('home') }}" class="list-group-item list-group-item-action">
                    <i class='bi bi-house me-2'></i> Home
                </a>
                <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action">
                    <i class='bi bi-speedometer2 me-2'></i> Dashboard
                </a>
                <a href="{{ route('child.index') }}" class="list-group-item list-group-item-action">
                    <i class='bi bi-people me-2'></i> Children
                </a>
                <a href="{{ route('sponsor.index') }}" class="list-group-item list-group-item-action">
                    <i class='bi bi-shop-window me-2'></i> Sponsor
                </a>
                <a href="{{ route('child.index') }}" class="list-group-item list-group-item-action">
                    <i class='bi bi-people me-2'></i> User
                </a>
                <a href="{{ route('child.index') }}" class="list-group-item list-group-item-action">
                    <i class='bi bi-person-circle me-2'></i> Profile
                </a>
                <a href="{{ route('logout') }}" class="list-group-item list-group-item-action">
                    <i class='bi bi-box-arrow-left me-2'></i> Logout
                </a>
            </div>
        </div>
        <div class='d-flex flex-row'>
            <img class='m-3 rounded-pill' alt='' src='https://placehold.co/50x50png' height='50'
                width='50' />
            <div class='text-white my-auto'>
                <b class='d-block'>{{ Auth::user()->name }}</b>
                <small class='d-block'>{{ Auth::user()->email }}</small>
            </div>
        </div>
    </div>
</div>
