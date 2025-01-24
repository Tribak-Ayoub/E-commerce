<!-- Product Form -->
<form id="product-form" action="{{ route('products.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Product Name</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>


    <div class="form-group">
        <label for="price">Price</label>
        <input type="number" name="price" id="price" class="form-control" required step="0.01">
    </div>

    <div class="form-group">
        <label for="Description">Description</label>
        <input type="number" name="Description" id="Description" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Add Product</button>
</form>
{{-- 
<script>
    // AJAX form submission
    $('#product-form').submit(function(e) {
        e.preventDefault();

        // Perform an AJAX POST request to store the product
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                alert(response.success); // Display success message
                // Optionally, you can clear the form and reload the product list
            },
            error: function(xhr) {
                // Handle errors (optional)
                alert('An error occurred. Please try again.');
            }
        });
    });
</script> --}}
