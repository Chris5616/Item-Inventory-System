<?php

namespace App\Livewire\Tables;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductTable extends Component
{
    use WithPagination;

    public $perPage = 25;
    public $search = '';
    public $sortField = 'id';
    public $sortAsc = false;

    /**
     * Sort the table by the given field.
     */
    public function sortBy($field): void
    {
        if ($this->sortField === $field) {
            $this->sortAsc = ! $this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    /**
     * Render the product table.
     */
    public function render()
    {
        return view('livewire.tables.product-table', [
            'products' => Product::query()
                ->with(['category', 'unit', 'supplier']) // ✅ include supplier
                ->search($this->search)
                ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                ->paginate($this->perPage),
        ]);
    }
}
