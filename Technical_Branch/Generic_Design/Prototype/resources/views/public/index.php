@extends('layouts.guest') 

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Our Products</h2>

        <div class="row mb-3">
            <div class="col-md-6">
                <form class="form-inline">
                    <div class="input-group input-group-sm w-100">
                        <select name="filter" id="filter" class="form-control custom-select">
                            <option value="" style="color: #ced4da;">Category Filter</option>
                            <option value="electronics">Electronics</option>
                            <option value="clothing">Clothing</option>
                            <option value="accessories">Accessories</option>
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-outline-dark">
                                <i class="fas fa-filter"></i> Filter
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <form class="form-inline">
                    <div class="input-group input-group-sm w-100">
                        <input class="form-control" type="search" placeholder="Search by product name" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-outline-dark">
                                <i class="fas fa-search"></i> Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                            <p class="card-text"><strong>Price:</strong> {{ $product->price }}€</p>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-3">
            {{ $products->links() }}
        </div>
    </div>
@endsection
