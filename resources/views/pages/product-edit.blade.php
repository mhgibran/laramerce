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
                <h1 class="h2">New Product</h1>
            </div>

            <form class="needs-validation" novalidate method="POST" action="{{ route('product.update', $product) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name">Product Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Product Name"
                        required value="{{ $product->name }}">
                </div>
                <div class="mb-3">
                    <label for="price">Product Price</label>
                    <input type="number" class="form-control" id="price" name="price" placeholder="Product Price"
                        required value="{{ $product->price }}">
                </div>
                <div class="mb-3">
                    @if ($product->image)
                        <img src="{{ $product->image ? asset('storage/public/' . $product->image) : env('DEFAULT_IMAGE') }}" alt="{{ $product->name }}" style="width: 96px; height: auto;">
                    @endif
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="image"
                            aria-describedby="image" accept=".jpg, .jpeg, .png" required>
                        <label class="custom-file-label" for="image">Change image</label>
                    </div>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ URL::Previous() }}" class="btn btn-secondary">Back</a>
                </div>
            </form>
        </main>
    </div>
</div>
@endsection
