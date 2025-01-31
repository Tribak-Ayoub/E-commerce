<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;

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
        // dd($products);
        // return Inertia::render('Products/Index', [
        //     'products' => $products->toArray(),
        // ]);
        return Inertia::render('Index', [
            'products' => $products->items(),  // Pass the items (products) only
        ]);    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = $this->productRepository->create($request->validated());
        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product = $this->productRepository->update($product, $request->validated());
        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $this->productRepository->delete($product);
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');

    }

    public function restore($product)
    {
        $this->productRepository->restore($product);
        return redirect()->route('products.index')->with('success', 'Product restored successfully');
    }
}
