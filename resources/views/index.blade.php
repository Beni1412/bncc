@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="display-4">Sweet Shop</h1>
            <p class="lead">Delicious treats for everyone!</p>
        </div>
        <div class="col-md-6">
            <form action="{{ route('home') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Search products..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Filters</h5>
                    <form action="{{ route('home') }}" method="GET">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="min_price" class="form-label">Min Price</label>
                                <input type="number" name="min_price" class="form-control" value="{{ request('min_price') }}">
                            </div>
                            <div class="col-md-4">
                                <label for="max_price" class="form-label">Max Price</label>
                                <input type="number" name="max_price" class="form-control" value="{{ request('max_price') }}">
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary me-2">Apply</button>
                                <a href="{{ route('home') }}" class="btn btn-outline-secondary">Reset</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <img src="{{ asset('storage/'.$product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                    <p class="h5 text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>
                <div class="card-footer bg-white">
                    <a href="{{ route('products.show', $product) }}" class="btn btn-outline-primary">View Details</a>
                    @auth
                    <form action="{{ route('cart.store') }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                    </form>
                    @endauth
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection