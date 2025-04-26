<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Items</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Manage Items</h1>

        <!-- Form Tambah Item -->
        <div class="bg-white p-6 rounded-lg shadow mb-6">
            <h2 class="text-xl font-semibold mb-4">Add New Item</h2>
            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('items.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium">Name</label>
                        <input type="text" name="name" class="w-full p-2 border rounded" value="{{ old('name') }}" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Price</label>
                        <input type="number" name="price" step="0.01" class="w-full p-2 border rounded" value="{{ old('price') }}" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Quantity</label>
                        <input type="number" name="quantity" class="w-full p-2 border rounded" value="{{ old('quantity') }}" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Category</label>
                        <select name="category_id" class="w-full p-2 border rounded" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Supplier</label>
                        <select name="supplier_id" class="w-full p-2 border rounded" required>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium">Description</label>
                        <textarea name="description" class="w-full p-2 border rounded">{{ old('description') }}</textarea>
                    </div>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-4">Add Item</button>
            </form>
        </div>

        <!-- Tabel Data Item -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-4">Item List</h2>
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-blue-600 text-white">
                        <th class="border p-2">Name</th>
                        <th class="border p-2">Description</th>
                        <th class="border p-2">Price</th>
                        <th class="border p-2">Quantity</th>
                        <th class="border p-2">Category</th>
                        <th class="border p-2">Supplier</th>
                        <th class="border p-2">Created By</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                        <tr>
                            <td class="border p-2">{{ $item->name }}</td>
                            <td class="border p-2">{{ $item->description ?? 'No description' }}</td>
                            <td class="border p-2">{{ number_format($item->price, 2) }}</td>
                            <td class="border p-2">{{ $item->quantity }}</td>
                            <td class="border p-2">{{ $item->category->name }}</td>
                            <td class="border p-2">{{ $item->supplier->name }}</td>
                            <td class="border p-2">{{ $item->creator->username }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="border p-2 text-center">No items found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <a href="{{ route('dashboard') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded mt-4 inline-block transition duration-200" style="background-color: #f97316;">Back to Dashboard</a>
    </div>
</body>
</html>