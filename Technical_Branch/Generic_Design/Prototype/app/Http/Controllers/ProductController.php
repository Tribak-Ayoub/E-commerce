<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (request()->ajax()) {
            return response()->json([
                'view' => view('admin.products.create')->render()
            ]);
        }
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        try {
            $product = $this->productRepository->create($request->validated());
            return response()->json([
                'status' => 200,
                'success' => true,
                'product' => $product,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Server Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = $this->productRepository->find($id);
        return view('admin.products.show', compact('product'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->productRepository->delete($id);

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
        // return response()->json([
        //     'status' => 200,
        //     'message' => 'Product deleted successfully.'
        // ]);
    
    }
}
