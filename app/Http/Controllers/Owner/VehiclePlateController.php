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

        return view('owner.vehicles.editplate', compact('vehicle'));
    }
    public function create($vehicleId)
    {
        $vehicle = Vehicle::find($vehicleId);
        return view('owner.vehicles.addplate', compact('vehicle'));
    }

    public function store(Request $request, $vehicleId)
    {
        $request->validate([
            'plate' => 'required|unique:car_plates|string|max:8',
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

    public function edit($vehicle, $plate)
    {
        $carPlate = CarPlate::where('plate', $plate)
            ->where('vehicles_id', $vehicle)
            ->first();

        return view('owner.vehicles.editplate', compact('carPlate'));
    }



    public function update(Request $request, $vehicleId, $plate)
    {
        $carPlate = CarPlate::where('plate', $plate)
            ->where('vehicles_id', $vehicleId)
            ->first();

        if ($carPlate) {
            $newPlateValue = $request->input('new_plate');

            $carPlate->plate = $newPlateValue;
            $carPlate->save();

            return redirect()->back()->with('success', 'Car plate updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Car plate not found.');
        }
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

            return redirect()->route('owner.vehicles.plates.index', $vehicleId)
                ->with('success', 'Car plate deleted successfully.');
        } else {
            // Handle the case where the car plate is not found
            return redirect()->route('owner.vehicles.plates.index', $vehicleId)
                ->with('error', 'Car plate not found.');
        }
    }


}
