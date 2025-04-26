<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Dashboard</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold">Total Items</h2>
                <p class="text-2xl">{{ $totalItems }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold">Total Categories</h2>
                <p class="text-2xl">{{ $totalCategories }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold">Total Suppliers</h2>
                <p class="text-2xl">{{ $totalSuppliers }}</p>
            </div>
        </div>
        <div class="mt-6 space-x-4">
            <a href="{{ route('items.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Manage Items</a>
            <a href="{{ route('categories.index') }}" class="bg-green-500 text-white px-4 py-2 rounded">Manage Categories</a>
            <a href="{{ route('suppliers.index') }}" class="bg-purple-500 text-white px-4 py-2 rounded">Manage Suppliers</a>
            <a href="{{ route('report.index') }}" class="bg-yellow-500 text-white px-4 py-2 rounded">View Report</a>
        </div>
    </div>
</body>
</html>