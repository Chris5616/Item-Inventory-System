<?php

namespace App\Http\Controllers\Dashboards;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Quotation;
use App\Models\Unit;
use App\Models\Supplier;


class DashboardController extends Controller
{
    public function index()
    {

        $products = Product::count();


        $units = Unit::count();
        $suppliers = Supplier::count();

        $categories = Category::count();



        return view('dashboard', [
            'products' => $products,
            'units' => $units,
            'suppliers' => $suppliers,
            'categories' => $categories,
        ]);
    }
}
