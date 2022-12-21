@extends('layouts.app')

@section('content')
<div class="container">
    <x-alert></x-alert>
    <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="{{ asset('logo.jpg') }}" alt="Logo" width="72"
            height="72">
        <h2>My Transaction</h2>
        <p class="lead">Now you can shop online wherever you are, happy shopping!</p>
    </div>

    <div class="table-responsive">
        <table class="table table-borderless">
            <tr>
                <th>Transaction Number</th>
                <th>:</th>
                <td>{{ $transaction->number }}</td>
            </tr>
            <tr>
                <th>Transaction Date</th>
                <th>:</th>
                <td>{{ \Carbon\Carbon::parse($transaction->date)->locale('id')->isoFormat('DD/MM/YYYY') }}</td>
            </tr>
            <tr>
                <th>Total</th>
                <th>:</th>
                <td>{{ 'Rp. ' . number_format($transaction->total) }}</td>
            </tr>
        </table>
        <h4 class="text-muted my-4">Product Items</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transaction->items as $key => $item)
                    @if ($item->product)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                <img src="{{ $item->product->image ? asset('storage/public/' . $item->product->image) : env('DEFAULT_IMAGE') }}" alt="{{ $item->product->name }}" style="width: 56px; height: auto; object-fit: cover;">
                            </td>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ 'Rp ' . number_format($item->product->price) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ 'Rp.' . number_format($item->product->price * $item->quantity) }}</td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="6">Product deleted!</td>
                        </tr>
                    @endif
                @empty
                    <tr>
                        <td colspan="6">Product items is empty! <a href="{{ route('home') }}">Let's start shopping!</a></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mb-4" style="max-width: 250px">
        <a href="{{ URL::Previous() }}" class="btn btn-secondary btn-lg btn-block">Go Back</a>
    </div>
</div>
@endsection
