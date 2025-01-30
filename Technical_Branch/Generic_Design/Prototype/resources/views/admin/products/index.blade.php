@extends('layouts.adminlte.adminlte')  

@section('content')
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Manage Products</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-6">
                    <!-- Use a button instead of an anchor tag -->
                    <button id="showCreateForm" class="btn btn-primary">
                        Add Product
                    </button>
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
                        <th>Description</th>
                        <th>Price</th>
                        <th style="width: 40px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td class="w-50">{{ $product->description}}</td>
                            <td>{{ $product->price }}€</td>
                            <td class="d-flex justify-content-around align-items-center">
                                <a href="{{ route('products.show', $product->id) }}"><i class="far fa-eye"></i></a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
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


    <script>
        $(document).ready(function () {
            // Show the create form in a modal
            $(document).on('click', '#showCreateForm', function (e) {
                e.preventDefault(); // Prevent default button behavior

                const url = "{{ route('products.create') }}"; // URL to fetch the form

                // Show a loading indicator in the dialog
                bootbox.dialog({
                    title: "Create Product",
                    message: `<div class="text-center"><i class="fas fa-spinner fa-spin"></i> Loading...</div>`,
                    size: 'large',
                    onEscape: true,
                    backdrop: true,
                });

                // Fetch the form via AJAX
                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function (response) {
                        // Replace loading indicator with the form
                        bootbox.dialog({
                            title: "Create Product",
                            message: response,
                            size: 'large',
                            onEscape: true,
                            backdrop: true,
                        });
                    },
                    error: function (xhr, status, error) {
                        bootbox.alert("Failed to load the form. Please try again.");
                    }
                });
            });

            // Handle form submission via AJAX
            $(document).on('submit', '#product-form', function (e) {
                e.preventDefault();
                const formData = new FormData(this);
                console.log("Submitting form data:", formData); // Debugging

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
                                    <td>${res.product.description}</td>
                                    <td>${res.product.price}€</td>
                                    <td class="d-flex justify-content-around align-items-center">
                                        <a href="/products/${res.product.id}"><i class="far fa-eye"></i></a>
                                        <form action="/products/${res.product.id}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            `);
                            bootbox.hideAll(); // Close the modal
                        } else {
                            bootbox.alert('Error: ' + res.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        $("button[type='submit']").prop("disabled", false).text('Submit');
                        bootbox.alert('Request failed: ' + error);
                    }
                });
            });
        });
    </script>
@endsection