@extends('layouts.tabler')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <h2 class="page-title">Product Details</h2>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    {{-- Image --}}
                    <div class="col-md-4 mb-3">
                       <img id="image-preview"
                        src="{{ $product->product_image ? asset('storage/products/' . $product->product_image)
                         : asset('assets/img/placeholder.png') }}"alt="Product Image" class="rounded">
                    </div>

                    {{-- Details --}}
                    <div class="col-md-8">
                        <p><strong>Name:</strong> {{ $product->name ?? 'N/A' }}</p>
                        <p><strong>Category:</strong> {{ $product->category->name ?? 'N/A' }}</p>
                        <p><strong>Supplier:</strong> {{ $product->supplier->name ?? 'N/A' }}</p>
                        <p><strong>Unit:</strong> {{ $product->unit->name ?? 'N/A' }}</p>
                        <p><strong>Buying Price:</strong> {{ $product->buying_price ?? 0 }}</p>
                        <p><strong>Selling Price:</strong> {{ $product->selling_price ?? 0 }}</p>
                        <p><strong>Quantity:</strong> {{ $product->quantity ?? 0 }}</p>
                        <p><strong>Quantity Alert:</strong> {{ $product->quantity_alert ?? 0 }}</p>
                        <p><strong>Tax:</strong> {{ $product->tax ?? 0 }}</p>
                        <p><strong>Tax Type:</strong> {{ $product->tax_type->name ?? 'N/A' }}</p>
                        <p><strong>Notes:</strong> {{ $product->notes ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
