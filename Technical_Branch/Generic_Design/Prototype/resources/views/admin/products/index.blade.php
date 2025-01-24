@extends('layouts.adminlte.adminlte')  <!-- Assuming you have a layout for AdminLTE -->

@section('content')
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Manage Products</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-6">
                    <a href="{{ route('products.create') }}" id="showCreateForm">
                        <button  class="btn btn-primary" >
                            Add Product
                        </button>
                    </a>

                </div>
                <div class="row col-6 justify-content-end">
                    <!-- Filter Column -->
                    <div class="col-md-6">
                        <form class="form-inline">
                            <div class="input-group input-group-sm w-100">
                                <!-- Filter Dropdown -->
                                <select name="filter" id="filter" class="form-control custom-select">
                                    <option value="" style="color: #ced4da;">Category Filter</option>
                                    <option value="electronics">Electronics</option>
                                    <option value="clothing">Clothing</option>
                                    <option value="accessories">Accessories</option>
                                </select>
                                <!-- Filter Button -->
                                <div class="input-group-append">
                                    <button class="btn btn-outline-dark" type="submit">
                                        <i class="fas fa-filter"></i> Filter
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Search Column -->
                    <div class="col-md-6">
                        <form class="form-inline">
                            <div class="input-group input-group-sm w-100">
                                <!-- Search Input -->
                                <input class="form-control" type="search" placeholder="Search by product name" aria-label="Search">
                                <!-- Search Button -->
                                <div class="input-group-append">
                                    <button class="btn btn-outline-dark" type="submit">
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
                        <th style="width: 10px">#</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock Quantity</th>
                        <th style="width: 40px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td><span class="badge badge-info p-2">{{ $product->category }}</span></td>
                            <td>{{ $product->price }}€</td>
                            <td>{{ $product->stock_quantity }}</td>
                            <td class="text-center">
                                <a href="{{ route('products.show', $product->id) }}"><i class="far fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            {{ $products->links() }}
        </div>
    </div>
@endsection

@push('scripts')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script> --}}
    <script>
        $(document).ready(function () {
        $(document).on('click', '#showCreateForm', function (e) {
            e.preventDefault();
            const url = $(this).attr('href');
    
            // Show a loading indicator in the dialog
            bootbox.dialog({
                title: "Create Product",
                message: `<div class="loading">Loading...</div>`,
                size: 'large',
            });
    
            $.ajax({
                type: 'GET',
                url: url,
                success: function (response) {
                    // Replace loading indicator with the form
                    // $(".loading").replaceWith(`<div class='form-container'>${response}</div>`);
                    bootbox.dialog({
                        title: "Create Product",
                        message: "<div class='form-container'></div>",

                    });
                    $('.createForm').html(response);
                },
                error: function (xhr, status, error) {
                    $(".loading").replaceWith(`<div class="error">Failed to load the form. Please try again.</div>`);
                }
            });
        });
    
        $(document).on('submit', '#product-form', function (e) {
            e.preventDefault();
            const formData = new FormData(this);
    
            // Show loading indicator during submission
            $("button[type='submit']").prop("disabled", true).text('Submitting...');
            
            $.ajax({
                type: 'POST',
                url: "{{ route('products.store') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function (res) {
                    $("button[type='submit']").prop("disabled", false).text('Submit');
                    if (res.success) {
                        // Dynamically append the new product
                        $('table tbody').append(`
                            <tr>
                                <td>${res.product.id}</td>
                                <td>${res.product.name}</td>
                                <td><span class="badge badge-info p-2">${res.product.category}</span></td>
                                <td>${res.product.price}€</td>
                                <td>${res.product.stock_quantity}</td>
                                <td class="text-center">
                                    <a href="/products/${res.product.id}"><i class="far fa-eye"></i></a>
                                </td>
                            </tr>
                        `);
                        bootbox.hideAll();
                    } else {
                        alert('Error: ' + res.message);
                    }
                },
                error: function (xhr, status, error) {
                    $("button[type='submit']").prop("disabled", false).text('Submit');
                    alert('Request failed: ' + error);
                }
            });
        });
    });
    </script>
@endpush
