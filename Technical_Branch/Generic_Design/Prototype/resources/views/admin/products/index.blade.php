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
                                    <button class="btn btn-outline-dark" >
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
                                    <button class="btn btn-outline-dark" >
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
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');" >
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">
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
        $(document).ready(function () {
            $(document).on('click', '#showCreateForm', function (e) {
                e.preventDefault();
                const url = "{{ route('products.create') }}";
    
                // Show a loading spinner in a modal (using Bootbox)
                bootbox.dialog({
                    title: "Create Product",
                    message: `<div class="text-center"><i class="fas fa-spinner fa-spin"></i> Loading...</div>`,
                    size: 'large',
                    onEscape: true,
                    backdrop: true,
                });
    
                // AJAX request to load the product creation form
                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function (response) {
                        if (response.view) {
                            // Replace the loading spinner with the actual form inside the modal
                            bootbox.dialog({
                                title: "Create Product",
                                message: response.view,
                                size: 'large',
                                onEscape: true,
                                backdrop: true,
                            });
                        } else {
                            bootbox.alert("Error loading form.");
                        }
                    },
                    error: function () {
                        bootbox.alert("Failed to load the form. Please try again.");
                    }
                });
            });
    
            $(document).on('submit', '#product-form', function (e) {
                e.preventDefault();
                let formData = new FormData(this);
                let submitButton = $("button[type='submit']");
                submitButton.prop("disabled", true).text('Submitting...');
    
                // AJAX request to submit the form data
                $.ajax({
                    type: 'POST',
                    url: "{{ route('products.store') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (res) {
                        submitButton.prop("disabled", false).text('Submit');
                        if (res.status === 200) {
                            // Append the new product row to the table
                            $('table tbody').append(`
                                <tr id="product-${res.product.id}">
                                    <td>${res.product.id}</td>
                                    <td>${res.product.name}</td>
                                    <td>${res.product.description}</td>
                                    <td>${res.product.price}€</td>
                                    <td class="d-flex justify-content-around align-items-center">
                                        <a href="/products/${res.product.id}"><i class="far fa-eye"></i></a>
                                        <form action="/products/${res.product.id}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');" >
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            `);
                            
                            // Hide the Bootbox modal after successful submission
                            bootbox.hideAll();
                        }
                    },
                    error: function (xhr) {
                        submitButton.prop("disabled", false).text('Submit');
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $('.error-message').remove();
                            $.each(errors, function (key, value) {
                                $(`[name=${key}]`).after(`<div class="text-danger error-message">${value[0]}</div>`);
                            });
                        } else {
                            bootbox.alert("An unexpected error occurred.");
                        }
                    }
                });
            });
        });
    </script>
    
@endsection
