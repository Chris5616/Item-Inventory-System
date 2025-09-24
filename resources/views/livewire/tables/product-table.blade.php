<style>
    /* ✅ General card responsiveness */
.card {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
}

/* ✅ Table tweaks */
.table th, .table td {
    font-size: 0.95rem;
    vertical-align: middle;
    white-space: nowrap;
}

/* ✅ Make dropdown buttons more touch-friendly */
.btn-action {
    padding: 6px 10px;
}

/* ✅ Responsive adjustments */
@media (max-width: 992px) {
    .card-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }

    .card-actions {
        margin-left: auto;
    }

    .table th, .table td {
        font-size: 0.85rem;
    }
}

@media (max-width: 768px) {
    .card-body .d-flex {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }

    .card-body .ms-auto {
        margin-left: 0 !important;
    }

    .table th, .table td {
        font-size: 0.8rem;
        padding: 6px;
    }

    .pagination {
        flex-wrap: wrap;
        justify-content: center;
        margin-top: 10px;
    }
}

@media (max-width: 576px) {
    .card-header h3 {
        font-size: 1.2rem;
    }

    .btn-action {
        padding: 4px 8px;
    }

    .table th, .table td {
        font-size: 0.75rem;
    }

    .dropdown-menu {
        font-size: 0.85rem;
    }
}

</style>

<div class="card">
    <div class="card-header">
        <div>
            <h3 class="card-title">
                {{ __('Products') }}
            </h3>
        </div>

        <div class="card-actions btn-group">
            <div class="dropdown">
                <a href="#" class="btn-action dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <x-icon.vertical-dots/>
                </a>
                <div class="dropdown-menu dropdown-menu-end" style="">
                    <a href="{{ route('products.create') }}" class="dropdown-item">
                        <x-icon.plus/>
                        {{ __('Create Product') }}
                    </a>
                    <a href="{{ route('products.import.view') }}" class="dropdown-item">
                        <x-icon.plus/>
                        {{ __('Import Products') }}
                    </a>
                    <a href="{{ route('products.export.store') }}" class="dropdown-item">
                        <x-icon.plus/>
                        {{ __('Export Products') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body border-bottom py-3">
        <div class="d-flex">
            <div class="text-secondary">
                Show
                <div class="mx-2 d-inline-block">
                    <select wire:model.live="perPage" class="form-select form-select-sm" aria-label="result per page">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="25">25</option>
                    </select>
                </div>
                entries
            </div>
            <div class="ms-auto text-secondary">
                Search:
                <div class="ms-2 d-inline-block">
                    <input type="text" wire:model.live="search" class="form-control form-control-sm" aria-label="Search invoice">
                </div>
            </div>
        </div>
    </div>

    <x-spinner.loading-spinner/>

    <div class="table-responsive">
        <table wire:loading.remove class="table table-bordered card-table table-vcenter text-nowrap datatable">
            <thead class="thead-light">
                <tr>
                    <th class="align-middle text-center w-1">
                        {{ __('No.') }}
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('name')" href="#" role="button">
                            {{ __('Name') }}
                            @include('includes._sort-icon', ['field' => 'name'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('code')" href="#" role="button">
                            {{ __('Code') }}
                            @include('includes._sort-icon', ['field' => 'code'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('category_id')" href="#" role="button">
                            {{ __('Category') }}
                            @include('includes._sort-icon', ['field' => 'category_id'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('quantity')" href="#" role="button">
                            {{ __('Quantity') }}
                            @include('includes._sort-icon', ['field' => 'quantity'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('supplier_name')" href="#" role="button">
                            {{ __('Supplier') }}
                            @include('includes._sort-icon', ['field' => 'supplier_name'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('quantity_alert')" href="#" role="button">
                            {{ __('Quantity Alert') }}
                            @include('includes._sort-icon', ['field' => 'quantity_alert'])
                        </a>
                    </th>

                    <th scope="col" class="align-middle text-center">
                        {{ __('Action') }}
                    </th>
                </tr>

            <tbody>
            @forelse ($products as $product)
                <tr>
                    <td class="align-middle text-center">
                        {{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}
                    </td>
                    <td class="align-middle">
                        {{ $product->name }}
                    </td>
                    <td class="align-middle text-center">
                        {{ $product->code }}
                    </td>
                    <td class="align-middle text-center">
                        {{ $product->category->name }}
                    </td>
                    <td class="align-middle text-center">
                        {{ $product->quantity }}
                    </td>
                    <td class="align-middle text-center">
                        {{ $product->supplier->name }}
                    </td>
                    <td class="align-middle text-center"
                        x-data="{ bgColor: 'transparent' }"
                        x-effect="bgColor = getBgColor({{ $product->quantity }}, {{ $product->quantity_alert }})"
                        :style="'background: ' + bgColor"
                    >
                        {{ $product->quantity_alert }}
                    </td>

                    <script>
                        function getBgColor(quantity, quantity_alert) {
                            if (quantity_alert >= quantity) {
                                return '#f8d7da'; // Red
                            } else if (quantity_alert === quantity - 1 || quantity_alert === quantity - 2) {
                                return '#fff70063'; // Yellow
                            }
                            return 'transparent';
                        }
                    </script>

                    <td class="align-middle text-center" style="width: 10%">
                        <x-button.show class="btn-icon" route="{{ route('products.show', $product) }}"/>
                        <x-button.edit class="btn-icon" route="{{ route('products.edit', $product) }}"/>
                        <x-button.delete class="btn-icon" route="{{ route('products.destroy', $product) }}"/>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="align-middle text-center" colspan="7">
                        No results found
                    </td>
                </tr>
            @endforelse
            </tbody>
            </thead>
        </table>
    </div>

    <div class="card-footer d-flex align-items-center">
        <p class="m-0 text-secondary">
            Showing <span>{{ $products->firstItem() }}</span>
            to <span>{{ $products->lastItem() }}</span> of <span>{{ $products->total() }}</span> entries
        </p>

        <ul class="pagination m-0 ms-auto">
            {{ $products->links() }}
        </ul>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
