<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link @if (Str::contains(Route::currentRouteName(), ['dashboard','transaction.show'])) active @endif" 
                    href="{{ route('dashboard') }}">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (Str::contains(Route::currentRouteName(), 'product')) active @endif" 
                    href="{{ route('product.index') }}">
                    <span data-feather="shopping-cart"></span>
                    Products
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (Str::contains(Route::currentRouteName(), 'user')) active @endif" 
                    href="{{ route('user.index') }}">
                    <span data-feather="shopping-cart"></span>
                    User
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (Str::contains(Route::currentRouteName(), 'report')) active @endif" 
                    href="{{ route('report.index') }}">
                    <span data-feather="shopping-cart"></span>
                    Reports
                </a>
            </li>
        </ul>
    </div>
</nav>
