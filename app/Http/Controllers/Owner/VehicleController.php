<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleRequest;
use App\Models\Brand;
use App\Models\Inventories;
use App\Models\Photo; // Import model Photo
use App\Models\Type;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::with('photos')->get(); // Mengambil semua kendaraan dengan foto-foto terkait
        return view('owner.vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        $brands = Brand::all();
        $types = Type::all();
        return view('owner.vehicles.create', compact('brands', 'types'));
    }

    public function store(VehicleRequest $request)
    {
        $validatedData = $request->validated();

        $vehicle = new Vehicle($validatedData);
        $vehicle->save();

        // Menangani foto
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('assets/item', 'public');

                // Buat entri Photo terpisah dan hubungkannya dengan Vehicle saat ini
                $photoModel = new Photo(['photos' => $path]);
                $vehicle->photos()->save($photoModel);
            }
        }

        $inventory = new Inventories([
            'vehicle_id' => $vehicle->id,
            'quantity' => 0, // Atur jumlah ke 0
            'available' => false, // Atur status 'available' ke false
        ]);
        $inventory->save();

        return redirect()->route('owner.vehicles.index')
            ->with('success', 'Vehicle created successfully.');
    }

    public function edit(Vehicle $vehicle)
    {
        $brands = Brand::all();
        $types = Type::all();
        return view('owner.vehicles.edit', compact('vehicle', 'brands', 'types'));
    }

    public function update(VehicleRequest $request, Vehicle $vehicle)
    {
        $validatedData = $request->validated();

        $vehicle->update($validatedData);

        // Menangani foto
        if ($request->hasFile('photos')) {
            $photos = [];
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('assets/item', 'public');

                $photoModel = new Photo(['photos' => $path]);
                $vehicle->photos()->save($photoModel);
            }
        }

        return redirect()->route('owner.vehicles.index')
            ->with('success', 'Vehicle updated successfully.');
    }

    public function destroy(Vehicle $vehicle)
    {
        // Periksa apakah ada Car Plate terkait dengan kendaraan ini
        $carPlatesCount = $vehicle->carPlates()->count();

        if ($carPlatesCount > 0) {
            return redirect()->route('owner.vehicles.index')
                ->with('error', 'Cannot delete the vehicle because it has associated Car Plates.');
        }

        // Hapus kendaraan jika tidak ada Car Plate terkait
        $vehicle->delete();

        return redirect()->route('owner.vehicles.index')
            ->with('success', 'Vehicle deleted successfully.');
    }


}

