@extends('layouts.adminlte.adminlte')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Product Details</h3>
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $product->name }}</p>
            <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
            <p><strong>Description:</strong> {{ $product->description }}</p>
        </div>
        <div class="card-footer text-right text-muted d-flex">
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary m-1">Back to List</a>
            <form class="m-1" action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete Product</button>
            </form>
        </div>
    </div>
</div>
@endsection
