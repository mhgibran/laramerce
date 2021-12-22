<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">LaraMerce</h5>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 @if (Route::currentRouteName() == 'home') text-blue @else text-dark @endif" 
            href="{{ route('home') }}">Home</a>
        <a class="p-2 @if (Str::contains(Route::currentRouteName(), 'cart')) text-blue @else text-dark @endif" 
            href="{{ route('cart.index') }}">Carts</a>
        <a class="p-2 @if (Str::contains(Route::currentRouteName(), 'transaction')) text-blue @else text-dark @endif" 
            href="{{ route('transaction.index') }}">My Transactions</a>
    </nav>
    <a class="btn btn-outline-danger" href="{{ route('logout') }}">
        Hi {{ Auth::user()->name . ', ' }} Logout
    </a>
</div>
