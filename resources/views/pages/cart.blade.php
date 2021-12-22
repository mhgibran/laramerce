@extends('layouts.app')

@section('content')
<div class="container">
    <x-alert></x-alert>
    <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="{{ asset('logo.jpg') }}" alt="Logo" width="72"
            height="72">
        <h2>Cart</h2>
        <p class="lead">Now you can shop online wherever you are, happy shopping!</p>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered ">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0;
                    $items = 0;
                @endphp
                @forelse ($carts as $key => $cart)
                    @php
                        $subtotal = $cart->product->price * $cart->quantity;
                        $items += $cart->quantity;
                        $total += $subtotal;
                    @endphp
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            <img src="{{ $cart->product->image ? asset('storage/public/' . $cart->product->image) : env('DEFAULT_IMAGE') }}" alt="{{ $cart->product->name }}" style="width: 56px; height: auto; object-fit: cover;">
                        </td>
                        <td>{{ $cart->product->name }}</td>
                        <td>{{ 'Rp ' . number_format($cart->product->price) }}</td>
                        <td>{{ $cart->quantity }}</td>
                        <td>{{ 'Rp ' . number_format($subtotal) }}</td>
                        <td>
                            <a href="{{ url('cart/subtract/'. $cart->id) }}" class="btn btn-sm btn-secondary">
                                -
                            </a>
                            <a href="{{ url('cart/plus/'. $cart->id) }}" class="btn btn-sm btn-secondary">
                                +
                            </a>
                            <a href="{{ url('cart/remove/'. $cart->id) }}" class="btn btn-sm btn-danger">
                                x
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">Cart is empty! <a href="{{ route('home') }}">Let's start shopping!</a></td>
                    </tr>
                @endforelse
            </tbody>
            @if ($items > 0)
                <tfoot>
                    <tr>
                        <th colspan="6" style="text-align: right;">Total Item</th>
                        <th style="text-align: right;">{{ $items }}</th>
                    </tr>
                    <tr>
                        <th colspan="6" style="text-align: right;">Total Shopping</th>
                        <th style="text-align: right;">{{ 'Rp. ' . number_format($total) }}</th>
                    </tr>
                </tfoot>
            @endif
        </table>
    </div>
    @if ($items > 0)
    <div class="mb-4" style="max-width: 250px">
        <form action="{{ route('transaction.store') }}" method="POST">
            @csrf
            <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
        </form>
    </div>
    @endif
</div>
@endsection
