<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\CarPlate;
use App\Models\Inventories;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehiclePlateController extends Controller
{
    public function index($vehicleId)
    {
        $vehicle = Vehicle::find($vehicleId);
        return view('owner.vehicles.addplate',compact('vehicle'));
    }
    public function create($vehicleId)
    {
        $vehicle = Vehicle::find($vehicleId);
        return view('owner.vehicles.index', compact('vehicle'));
    }

    public function store(Request $request, $vehicleId)
    {
        $request->validate([
            'plate' => 'required|unique:car_plates|string',
        ]);

        $carPlate = new CarPlate([
            'plate' => $request->input('plate'),
            'vehicles_id' => $vehicleId,
        ]);

        $carPlate->save();

        $vehicle = Vehicle::find($vehicleId);
        $inventory = $vehicle->inventory;

        if (!$inventory) {
            $inventory = new Inventories([
                'vehicle_id' => $vehicleId,
                'quantity' => 0,
                'available' => false,
            ]);
            $inventory->save();
        }

        $inventory->calculateQuantity();


        return redirect()->route('owner.vehicles.index')
            ->with('success', 'Car plate added successfully.');
    }

    public function edit($vehicleId, $plate)
    {
        $carPlate = CarPlate::where('plate', $plate)
            ->where('vehicles_id', $vehicleId)
            ->first();

        return view('owner.vehicles.addplate', compact('carPlate'));
    }

    public function update(Request $request, $vehicleId, $plate)
    {
        $request->validate([
            'plate' => 'required|string',
        ]);

        $carPlate = CarPlate::where('plate', $plate)
            ->where('vehicles_id', $vehicleId)
            ->first();

        if ($carPlate) {
            $carPlate->plate = $request->input('plate');
            $carPlate->save();
        }

        return redirect()->route('owner.vehicles.index')
            ->with('success', 'Car plate updated successfully.');
    }

    public function destroy($vehicleId, $plate)
    {
        $carPlate = CarPlate::where('plate', $plate)
            ->where('vehicles_id', $vehicleId)
            ->first();

        if ($carPlate) {
            $carPlate->delete();

            // Hitung ulang quantity
            $vehicle = Vehicle::find($vehicleId);
            $inventory = $vehicle->inventory;
            $inventory->calculateQuantity();
        }

        return redirect()->route('owner.vehicles.index')
            ->with('success', 'Car plate deleted successfully.');
    }
}
