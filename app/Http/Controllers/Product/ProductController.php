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
            // Create product with adjusted quantity_alert
            $product = Product::create($this->prepareProductData($request));

            // Handle image upload
            if ($request->hasFile('product_image')) {
                $this->uploadProductImage($request->file('product_image'), $product);
            }

            return redirect()
                ->route('products.index')
                ->with('success', 'Product has been created with code: ' . $product->code);

        } catch (\Exception $e) {
            Log::error('Product creation failed: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Something went wrong while creating the product']);
        }
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
       try {
        // Get input quantity from form
        $quantity = $request->get('quantity');

        // Deduct input quantity from existing quantity_alert
        $product->quantity_alert = max($product->quantity_alert - $quantity, 0);

        // Update other fields except product_image and quantity_alert
        $product->update($request->except('product_image', 'quantity_alert'));

        // Save adjusted quantity_alert
        $product->save();

        // Handle product image if uploaded
        if ($request->hasFile('product_image')) {
            // Delete old image if exists
            if ($product->product_image && Storage::disk('public')->exists('products/' . $product->product_image)) {
                Storage::disk('public')->delete('products/' . $product->product_image);
            }

            $this->uploadProductImage($request->file('product_image'), $product);
        }

        return redirect()
            ->route('products.index')
            ->with('success', 'Product has been updated!');

    } catch (\Exception $e) {
        Log::error('Product update failed: ' . $e->getMessage());
        return back()->withErrors(['error' => 'Something went wrong while updating the product']);
    }
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

    /**
     * Prepare product data including adjusted quantity_alert
     */
    private function prepareProductData($request)
    {
        $quantity = $request->get('quantity');
        $quantityAlert = $request->get('quantity_alert');

        $adjustedQuantityAlert = max($quantityAlert - $quantity, 0);

        return array_merge(
            $request->except('product_image', 'quantity_alert'),
            ['quantity_alert' => $adjustedQuantityAlert]
        );
    }

    /**
     * Upload product image and update the product
     */
    private function uploadProductImage($file, Product $product)
    {
        if ($file->isValid()) {
            $filename = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('products', $filename, 'public');

            $product->update([
                'product_image' => $filename
            ]);
        }
    }

    /**
     * Generate unique product code
     */
    private function generateUniqueCode()
    {
        do {
            $code = strtoupper(uniqid('PRD-'));
        } while (Product::where('code', $code)->exists());

        return $code;
    }
}
