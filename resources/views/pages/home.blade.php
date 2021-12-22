@extends('layouts.app')

@prepend('styles')
    <link rel="stylesheet" href="{{ asset('css/pricing.css') }}">
@endprepend

@section('content')
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">Product Lists</h1>
    <p class="lead">Now you can shop online wherever you are, happy shopping!</p>
</div>

<div class="container">
    <div class="mb-3 row">
        @forelse ($products as $product)
            <div class="col-sm-12 col-md-3">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <img src="{{ $product->image ? asset('storage/public/' . $product->image) : env('DEFAULT_IMAGE') }}" alt="{{ $product->name }}" style="width: 100%; height: 180px; object-fit: cover;">
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>{{ $product->name }}</li>
                            <li>{{ 'Rp. ' . number_format($product->price) }}</li>
                        </ul>
                        <form action="{{ route('cart.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="productId" value="{{ $product->id }}">
                            <button type="submit" class="btn btn-lg btn-block btn-outline-primary">Add To Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">No product found!</p>
        @endforelse
    </div>
</div>
@endsection
