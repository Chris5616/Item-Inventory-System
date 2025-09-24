<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Picqer\Barcode\BarcodeGeneratorHTML;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'unit', 'supplier'])
            ->latest()
            ->paginate(10);

        return view('products.index', [
            'products' => $products,
        ]);
    }

    public function create(Request $request)
    {
        $categories = Category::all(['id', 'name']);
        $units = Unit::all(['id', 'name']);
        $suppliers = Supplier::all(['id', 'name']);

        return view('products.create', compact('categories', 'units', 'suppliers'));
    }

    public function store(StoreProductRequest $request)
    {
        $existingProduct = Product::where('code', $request->get('code'))->first();

        if ($existingProduct) {
            $newCode = $this->generateUniqueCode();
            $request->merge(['code' => $newCode]);
        }

        try {
            $product = Product::create($request->except('product_image'));

            // Handle image upload
            if ($request->hasFile('product_image')) {
                $file = $request->file('product_image');
                $filename = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();

                if ($file->isValid()) {
                    $file->storeAs('products', $filename, 'public');

                    $product->update([
                        'product_image' => $filename
                    ]);
                } else {
                    return back()->withErrors(['product_image' => 'Invalid image file']);
                }
            }

            return redirect()
                ->route('products.index')
                ->with('success', 'Product has been created with code: ' . $product->code);

        } catch (\Exception $e) {
            Log::error('Product creation failed: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Something went wrong while creating the product']);
        }
    }

    // Helper method to generate a unique product code
    private function generateUniqueCode()
    {
        do {
            $code = 'PC' . strtoupper(uniqid());
        } while (Product::where('code', $code)->exists());

        return $code;
    }

    public function show(Product $product)
    {
        $generator = new BarcodeGeneratorHTML();
        $barcode = $generator->getBarcode($product->code, $generator::TYPE_CODE_128);

        return view('products.show', [
            'product' => $product,
            'barcode' => $barcode,
        ]);
    }

    public function edit(Product $product)
    {
        return view('products.edit', [
            'categories' => Category::all(),
            'units' => Unit::all(),
            'suppliers' => Supplier::all(),
            'product' => $product
        ]);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->except('product_image'));

        if ($request->hasFile('product_image')) {
            // Delete old image if exists
            if ($product->product_image && Storage::disk('public')->exists('products/' . $product->product_image)) {
                Storage::disk('public')->delete('products/' . $product->product_image);
            }

            // Upload new image
            $file = $request->file('product_image');
            $fileName = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('products', $fileName, 'public');

            $product->update([
                'product_image' => $fileName
            ]);
        }

        return redirect()
            ->route('products.index')
            ->with('success', 'Product has been updated!');
    }

    public function destroy(Product $product)
    {
        if ($product->product_image && Storage::disk('public')->exists('products/' . $product->product_image)) {
            Storage::disk('public')->delete('products/' . $product->product_image);
        }

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Product has been deleted!');
    }
}
