<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->productRepository->all();
        return response()->json($products); // Return products as JSON
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // This method is typically used for rendering a form in a Blade view.
        // Since you're using Vue for the frontend, this method can remain empty.
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
        ]);

        // Create the product using the repository
        $product = $this->productRepository->create($validatedData);

        // Return the created product as JSON
        return response()->json($product, 201); // 201: Created
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the product using the repository
        $product = $this->productRepository->find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404); // 404: Not Found
        }

        // Return the product as JSON
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // This method is typically used for rendering a form in a Blade view.
        // Since you're using Vue for the frontend, this method can remain empty.
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'price' => 'sometimes|numeric|min:0',
        ]);

        // Find the product using the repository
        $product = $this->productRepository->find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404); // 404: Not Found
        }

        // Update the product using the repository
        $this->productRepository->update($id, $validatedData);

        // Return the updated product as JSON
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the product using the repository
        $product = $this->productRepository->find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404); // 404: Not Found
        }

        // Delete the product using the repository
        $this->productRepository->delete($id);

        // Return a success response
        return response()->json(['message' => 'Product deleted successfully']);
    }
}