<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Http\Requests\Supplier\StoreSupplierRequest;
use App\Http\Requests\Supplier\UpdateSupplierRequest;
use Illuminate\Support\Facades\Storage;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();

        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(StoreSupplierRequest $request)
    {
        $supplier = Supplier::create($request->except('image'));

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
        $file->storeAs('suppliers', $filename, 'public');

        $supplier->update(['image' => $filename]);
    }

    return redirect()
        ->route('suppliers.index')
        ->with('success', 'New supplier has been created!');
    }

    public function show(Supplier $supplier)
    {
          $suppliers = Supplier::all();

        return view('suppliers.show', compact('suppliers'));
    }

    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $supplier->update($request->except('image'));

        if ($request->hasFile('image')) {
            // Delete old file if exists
            if ($supplier->image && Storage::disk('public')->exists('suppliers/' . $supplier->image)) {
                Storage::disk('public')->delete('suppliers/' . $supplier->image);
            }

            // Save new image
            $file = $request->file('image');
            $filename = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('suppliers', $filename, 'public');

            $supplier->update([
                'image' => $filename
            ]);
        }

        return redirect()
            ->route('suppliers.index')
            ->with('success', 'Supplier has been updated!');
    }

    public function destroy(Supplier $supplier)
    {
        if ($supplier->image && Storage::disk('public')->exists('suppliers/' . $supplier->image)) {
            Storage::disk('public')->delete('suppliers/' . $supplier->image);
        }

        $supplier->delete();

        return redirect()
            ->route('suppliers.index')
            ->with('success', 'Supplier has been deleted!');
    }
}
