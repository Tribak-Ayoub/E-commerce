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
        <input type="text" name="description" id="Description" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Add Product</button>
</form>
