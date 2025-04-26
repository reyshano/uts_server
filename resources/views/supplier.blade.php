<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Suppliers</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Manage Suppliers</h1>

        <!-- Form Tambah Supplier -->
        <div class="bg-white p-6 rounded-lg shadow mb-6">
            <h2 class="text-xl font-semibold mb-4">Add New Supplier</h2>
            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            <form action="{{ route('suppliers.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium">Name</label>
                        <input type="text" name="name" class="w-full p-2 border rounded" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Contact Info</label>
                        <input type="text" name="contact_info" class="w-full p-2 border rounded">
                    </div>
                </div>
                <button type="submit" class="bg-purple-500 text-white px-4 py-2 rounded mt-4">Add Supplier</button>
            </form>
        </div>

        <!-- Tabel Data Supplier -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-4">Supplier List</h2>
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-blue-600 text-white">
                        <th class="border p-2">Name</th>
                        <th class="border p-2">Contact Info</th>
                        <th class="border p-2">Created By</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($suppliers as $supplier)
                        <tr>
                            <td class="border p-2">{{ $supplier->name }}</td>
                            <td class="border p-2">{{ $supplier->contact_info }}</td>
                            <td class="border p-2">{{ $supplier->creator->username }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <a href="{{ route('dashboard') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded mt-4 inline-block transition duration-200" style="background-color: #f97316;">Back to Dashboard</a>
    </div>
</body>
</html>