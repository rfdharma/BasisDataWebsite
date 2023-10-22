<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('owner.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('owner.brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // tambahkan aturan validasi sesuai kebutuhan
        ]);

        // Periksa apakah sudah ada merek dengan nama yang sama
        $existingBrand = Brand::where('name', $request->name)->first();

        if ($existingBrand) {
            return redirect()->route('owner.brands.create')
                ->with('error', 'Merek dengan nama yang sama sudah ada.');
        }

        Brand::create($request->all());

        return redirect()->route('owner.brands.index')
            ->with('success', 'Brand created successfully.');
    }

    public function show(Brand $brand)
    {
//        return view('owner.brands.show', compact('brand'));
    }

    public function edit(Brand $brand)
    {
        return view('owner.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // tambahkan aturan validasi sesuai kebutuhan
        ]);

        $brand->update($request->all());

        return redirect()->route('owner.brands.index')
            ->with('success', 'Brand updated successfully');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();

        return redirect()->route('owner.brands.index')
            ->with('success', 'Brand deleted successfully');
    }
}
