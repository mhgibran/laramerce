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
                <h1 class="h2">Product Data</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                        <a href="{{ route('product.create') }}" class="btn btn-sm btn-outline-primary">+ Add Product</a>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $key => $product)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <img src="{{ $product->image ? asset('storage/public/' . $product->image) : env('DEFAULT_IMAGE') }}" alt="{{ $product->name }}" style="width: 56px; height: auto; object-fit: cover;">
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ 'Rp. ' . number_format($product->price) }}</td>
                                <td>
                                    <a href="{{ route('product.show', $product->id) }}" class="btn btn-sm btn-primary">
                                        Edit
                                    </a>
                                    <form action="{{ route('product.destroy', $product) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">No product data found!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
