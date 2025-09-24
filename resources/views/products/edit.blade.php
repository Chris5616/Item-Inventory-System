@extends('layouts.tabler')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <x-alert />

        <form action="{{ route('products.update', $product->slug) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                {{-- Product Name --}}
                <div class="col-sm-6 col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $product->name) }}" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Product Code --}}
                <div class="col-sm-6 col-md-6">
                    <div class="mb-3">
                        <label for="code" class="form-label">Product Code <span class="text-danger">*</span></label>
                        <input type="text" name="code" id="code"
                               class="form-control @error('code') is-invalid @enderror"
                               value="{{ old('code', $product->code) }}" required>
                        @error('code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Category --}}
                <div class="col-sm-6 col-md-6">
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                        <select name="category_id" id="category_id"
                                class="form-select @error('category_id') is-invalid @enderror" required>
                            <option disabled>Select a category:</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    @if(old('category_id', $product->category_id) == $category->id) selected @endif>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Supplier --}}
                <div class="col-sm-6 col-md-6">
                    <div class="mb-3">
                        <label for="supplier_id" class="form-label">Supplier <span class="text-danger">*</span></label>
                        <select name="supplier_id" id="supplier_id"
                                class="form-select @error('supplier_id') is-invalid @enderror" required>
                            <option disabled>Select a supplier:</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}"
                                    @if(old('supplier_id', $product->supplier_id) == $supplier->id) selected @endif>
                                    {{ $supplier->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('supplier_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Unit --}}
                <div class="col-sm-6 col-md-6">
                    <div class="mb-3">
                        <label for="unit_id" class="form-label">Unit <span class="text-danger">*</span></label>
                        <select name="unit_id" id="unit_id"
                                class="form-select @error('unit_id') is-invalid @enderror" required>
                            <option disabled>Select a unit:</option>
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}"
                                    @if(old('unit_id', $product->unit_id) == $unit->id) selected @endif>
                                    {{ $unit->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('unit_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Quantity --}}
                <div class="col-sm-6 col-md-6">
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity <span class="text-danger">*</span></label>
                        <input type="number" name="quantity" id="quantity"
                               class="form-control @error('quantity') is-invalid @enderror"
                               value="{{ old('quantity', $product->quantity) }}" required>
                        @error('quantity') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>


                {{-- Tax --}}
                <div class="col-sm-6 col-md-6">
                    <div class="mb-3">
                        <label for="tax" class="form-label">Tax <span class="text-danger">*</span></label>
                        <input type="number" name="quantity" id="tax"
                               class="form-control @error('tax') is-invalid @enderror"
                               value="{{ old('tax', $product->tax) }}" required>
                        @error('tax') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Tax type --}}
                <div class="col-sm-6 col-md-6">
                    <div class="mb-3">
                        <label for="tax_type" class="form-label required">Tax Type</label>
                            <select class="form-select @error('tax_type') is-invalid @enderror" id="bank_name" name="bank_name">
                                <option value="inclusive" @if(old('bank_name', $supplier->bank_name) == 'inclusive')selected="selected"@endif>inclusive</option>
                                <option value="exclusive" @if(old('bank_name', $supplier->bank_name) == 'exclusive')selected="selected"@endif>exclusive</option>
                            </select> @error('tax_type')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                {{-- Quantity Alert --}}
                <div class="col-sm-6 col-md-6">
                    <div class="mb-3">
                        <label for="quantity_alert" class="form-label">Quantity Alert <span class="text-danger">*</span></label>
                        <input type="number" name="quantity_alert" id="quantity_alert"
                               class="form-control @error('quantity_alert') is-invalid @enderror"
                               value="{{ old('quantity_alert', $product->quantity_alert) }}" required>
                        @error('quantity_alert') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Buying Price --}}
                <div class="col-sm-6 col-md-6">
                    <div class="mb-3">
                        <label for="buying_price" class="form-label">Buying Price <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" name="buying_price" id="buying_price"
                               class="form-control @error('buying_price') is-invalid @enderror"
                               value="{{ old('buying_price', $product->buying_price) }}" required>
                        @error('buying_price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Selling Price --}}
                <div class="col-sm-6 col-md-6">
                    <div class="mb-3">
                        <label for="selling_price" class="form-label">Selling Price <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" name="selling_price" id="selling_price"
                               class="form-control @error('selling_price') is-invalid @enderror"
                               value="{{ old('selling_price', $product->selling_price) }}" required>
                        @error('selling_price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Product Image --}}
                <div class="col-sm-6 col-md-6">
                    <div class="mb-3">
                        <label for="product_image" class="form-label">Product Image</label>
                        <input type="file" name="product_image" id="product_image"
                               class="form-control @error('product_image') is-invalid @enderror"
                               onchange="previewImage();">

                        {{-- Existing image or placeholder --}}
                        <div class="mt-2">
                            <img id="image-preview"
                                 src="{{ $product->product_image ? asset('storage/products/' . $product->product_image) : asset('assets/img/placeholder.png') }}"
                                 alt="Product Image" width="120" class="rounded">
                        </div>

                        @error('product_image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Notes --}}
                <div class="col-12">
                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea name="notes" id="notes"
                                  class="form-control @error('notes') is-invalid @enderror"
                                  rows="3">{{ old('notes', $product->notes) }}</textarea>
                        @error('notes') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="form-footer">
                <button type="submit" class="btn btn-primary">Update Product</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewImage() {
    const input = document.getElementById('product_image');
    const preview = document.getElementById('image-preview');

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
