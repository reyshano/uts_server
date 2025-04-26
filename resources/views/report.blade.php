<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Report</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Inventory Report</h1>

        <!-- 1. Ringkasan Stok Barang -->
        <div class="bg-white p-6 rounded-lg shadow mb-6">
            <h2 class="text-xl font-semibold mb-4">Stock Summary</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <p class="text-gray-600">Total Stock</p>
                    <p class="text-2xl font-bold">{{ $totalStock }} units</p>
                </div>
                <div>
                    <p class="text-gray-600">Total Stock Value</p>
                    <p class="text-2xl font-bold">Rp {{ number_format($totalStockValue, 2) }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Average Price</p>
                    <p class="text-2xl font-bold">Rp {{ number_format($averagePrice, 2) }}</p>
                </div>
            </div>
        </div>

        <!-- 2. Barang dengan Stok Rendah -->
        <div class="bg-white p-6 rounded-lg shadow mb-6">
            <h2 class="text-xl font-semibold mb-4">Low Stock Items (Below 5 Units)</h2>
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-blue-600 text-white">
                        <th class="border p-2">Name</th>
                        <th class="border p-2">Quantity</th>
                        <th class="border p-2">Category</th>
                        <th class="border p-2">Supplier</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($lowStockItems as $item)
                        <tr>
                            <td class="border p-2">{{ $item->name }}</td>
                            <td class="border p-2 text-red-600">{{ $item->quantity }}</td>
                            <td class="border p-2">{{ $item->category->name }}</td>
                            <td class="border p-2">{{ $item->supplier->name }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="border p-2 text-center">No low stock items</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- 3. Laporan Barang Berdasarkan Kategori -->
        <div class="bg-white p-6 rounded-lg shadow mb-6">
            <h2 class="text-xl font-semibold mb-4">Items by Category</h2>
            <form method="GET" action="{{ route('report.index') }}" class="mb-4">
                <div class="flex items-center space-x-4">
                    <label class="block text-sm font-medium">Select Category</label>
                    <select name="category_id" class="p-2 border rounded" onchange="this.form.submit()">
                        <option value="">-- Select Category --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $selectedCategory == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </form>
            @if ($selectedCategory)
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-blue-600 text-white">
                            <th class="border p-2">Name</th>
                            <th class="border p-2">Description</th>
                            <th class="border p-2">Price</th>
                            <th class="border p-2">Quantity</th>
                            <th class="border p-2">Supplier</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categoryItems as $item)
                            <tr>
                                <td class="border p-2">{{ $item->name }}</td>
                                <td class="border p-2">{{ $item->description ?? 'No description' }}</td>
                                <td class="border p-2">Rp {{ number_format($item->price, 2) }}</td>
                                <td class="border p-2">{{ $item->quantity }}</td>
                                <td class="border p-2">{{ $item->supplier->name }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="border p-2 text-center">No items in this category</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            @endif
        </div>

        <!-- 4. Ringkasan Per Kategori -->
        <div class="bg-white p-6 rounded-lg shadow mb-6">
            <h2 class="text-xl font-semibold mb-4">Category Summary</h2>
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-blue-600 text-white">
                        <th class="border p-2">Category</th>
                        <th class="border p-2">Item Count</th>
                        <th class="border p-2">Total Stock Value</th>
                        <th class="border p-2">Average Price</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categorySummary as $summary)
                        <tr>
                            <td class="border p-2">{{ $summary->name }}</td>
                            <td class="border p-2">{{ $summary->item_count }}</td>
                            <td class="border p-2">Rp {{ number_format($summary->total_value ?? 0, 2) }}</td>
                            <td class="border p-2">Rp {{ number_format($summary->avg_price ?? 0, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="border p-2 text-center">No categories found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- 5. Ringkasan Per Pemasok -->
        <div class="bg-white p-6 rounded-lg shadow mb-6">
            <h2 class="text-xl font-semibold mb-4">Supplier Summary</h2>
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-blue-600 text-white">
                        <th class="border p-2">Supplier</th>
                        <th class="border p-2">Item Count</th>
                        <th class="border p-2">Total Stock Value</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($supplierSummary as $summary)
                        <tr>
                            <td class="border p-2">{{ $summary->name }}</td>
                            <td class="border p-2">{{ $summary->item_count }}</td>
                            <td class="border p-2">Rp {{ number_format($summary->total_value ?? 0, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="border p-2 text-center">No suppliers found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- 6. Ringkasan Keseluruhan Sistem -->
        <div class="bg-white p-6 rounded-lg shadow mb-6">
            <h2 class="text-xl font-semibold mb-4">Overall System Summary</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <p class="text-gray-600">Total Items</p>
                    <p class="text-2xl font-bold">{{ $totalItems }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Total Stock Value</p>
                    <p class="text-2xl font-bold">Rp {{ number_format($totalStockValueOverall, 2) }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Total Categories</p>
                    <p class="text-2xl font-bold">{{ $totalCategories }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Total Suppliers</p>
                    <p class="text-2xl font-bold">{{ $totalSuppliers }}</p>
                </div>
            </div>
        </div>

        <a href="{{ route('dashboard') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded mt-4 inline-block transition duration-200" style="background-color: #f97316;">Back to Dashboard</a>
    </div>
</body>
</html>