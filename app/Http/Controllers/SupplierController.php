<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::with('creator')->get();
        return view('supplier', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'contact_info' => 'nullable|string|max:100',
        ]);

        Supplier::create([
            'name' => $request->name,
            'contact_info' => $request->contact_info,
            'created_by' => Auth::id() ?? 1,
        ]);

        return redirect()->route('suppliers.index')->with('success', 'Supplier added successfully');
    }
}