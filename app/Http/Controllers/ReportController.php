<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\Supplier;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ringkasan stok barang
        $totalStock = Item::sum('quantity');
        $totalStockValue = Item::selectRaw('SUM(price * quantity) as total_value')->first()->total_value ?? 0;
        $averagePrice = Item::avg('price') ?? 0;

        // 2. Barang dengan stok di bawah ambang batas (5 unit)
        $lowStockItems = Item::where('quantity', '<', 5)
            ->with(['category', 'supplier'])
            ->get();

        // 3. Laporan barang berdasarkan kategori tertentu
        $selectedCategory = $request->input('category_id');
        $categoryItems = [];
        if ($selectedCategory) {
            $categoryItems = Item::where('category_id', $selectedCategory)
                ->with(['category', 'supplier'])
                ->get();
        }
        $categories = Category::all();

        // 4. Ringkasan per kategori
        $categorySummary = Category::select('categories.id', 'categories.name')
            ->leftJoin('items', 'categories.id', '=', 'items.category_id')
            ->groupBy('categories.id', 'categories.name')
            ->selectRaw('COUNT(items.id) as item_count')
            ->selectRaw('SUM(items.price * items.quantity) as total_value')
            ->selectRaw('AVG(items.price) as avg_price')
            ->get();

        // 5. Ringkasan per pemasok
        $supplierSummary = Supplier::select('suppliers.id', 'suppliers.name')
            ->leftJoin('items', 'suppliers.id', '=', 'items.supplier_id')
            ->groupBy('suppliers.id', 'suppliers.name')
            ->selectRaw('COUNT(items.id) as item_count')
            ->selectRaw('SUM(items.price * items.quantity) as total_value')
            ->get();

        // 6. Ringkasan keseluruhan sistem
        $totalItems = Item::count();
        $totalStockValueOverall = $totalStockValue;
        $totalCategories = Category::count();
        $totalSuppliers = Supplier::count();

        return view('report', compact(
            'totalStock', 'totalStockValue', 'averagePrice',
            'lowStockItems',
            'categoryItems', 'categories', 'selectedCategory',
            'categorySummary',
            'supplierSummary',
            'totalItems', 'totalStockValueOverall', 'totalCategories', 'totalSuppliers'
        ));
    }
}