@extends('layouts.adminlte.adminlte')

@section('content')
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Manage Products</h3>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-6">
                <button id="showCreateForm" class="btn btn-primary">Add Product</button>
            </div>
            <div class="row col-6 justify-content-end">
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
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr id="product-{{ $product->id }}">
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td class="w-50">{{ $product->description}}</td>
                    <td>{{ $product->price }}€</td>
                    <td class="d-flex justify-content-around align-items-center">
                        <a href="{{ route('products.show', $product->id) }}"><i class="far fa-eye"></i></a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger delete-product" data-id="{{ $product->id }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer clearfix">
        {{ $products->links() }}
    </div>
</div>


<script>
    let createProductUrl = "{{ route('products.create') }}";
    let storeProductUrl = "{{ route('products.store') }}";
</script>

@endsection