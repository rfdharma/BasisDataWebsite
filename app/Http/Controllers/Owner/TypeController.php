<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index()
    {
        $types = Type::all();
        return view('owner.types.index', compact('types'));
    }

    public function create()
    {
        return view('owner.types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // Tambahkan aturan validasi sesuai kebutuhan
        ]);

        Type::create($request->all());

        return redirect()->route('owner.types.index')
            ->with('success', 'Type created successfully.');
    }

    public function edit(Type $type)
    {
        return view('owner.types.edit', compact('type'));
    }

    public function update(Request $request, Type $type)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // Tambahkan aturan validasi sesuai kebutuhan
        ]);

        $type->update($request->all());

        return redirect()->route('owner.types.index')
            ->with('success', 'Type updated successfully.');
    }

    public function destroy(Type $type)
    {
        $type->delete();

        return redirect()->route('owner.types.index')
            ->with('success', 'Type deleted successfully.');
    }
}
