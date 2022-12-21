@extends('layouts.app')

@prepend('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endprepend

@section('content')
<div class="container-fluid">
    <div class="row">
        <x-sidemenu></x-sidemenu>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <x-alert></x-alert>
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Transaction Detail</h1>
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
                                </tr>
                            @else
                                <tr>
                                    <td colspan="5">Product is deleted</td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="5">Product items is empty! <a href="{{ route('home') }}">Let's start shopping!</a></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="py-4">
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Go Back</a>
            </div>
        </main>
    </div>
</div>
@endsection
