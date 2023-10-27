<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\CarPlate;
use App\Models\RentalPlate;
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
            'plate' => 'required|unique:car_plates|string|max:9',
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
        // Check if the car plate exists in the car_plates table
        $carPlate = CarPlate::where('plate', $plate)
            ->where('vehicles_id', $vehicleId)
            ->first();

        if (!$carPlate) {
            return redirect()->back()->with('error', 'Car plate not found in car_plates.');
        }

        // Check if the car plate exists in the rental_plates table (including soft-deleted records)
        $rentalPlate = RentalPlate::where('plate', $plate)
            ->where('vehicle_id', $vehicleId)
            ->first();

        if (!$rentalPlate) {
            $newPlateValue = $request->input('new_plate');

            // Update the car plate with the new value in car_plates
            $carPlate->plate = $newPlateValue;
            $carPlate->save();

            // Check if the car plate exists in the rental_plates table (including soft-deleted records)
            $rentalPlate = RentalPlate::withTrashed()
                ->where('plate', $plate)
                ->where('vehicle_id', $vehicleId)
                ->first();

            if ($rentalPlate) {
                // Update the car plate with the new value in rental_plates
                $rentalPlate->plate = $newPlateValue;
                $rentalPlate->save();
            }

            return redirect()->back()->with('success', 'Car plate updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Car plates cannot be renewed because they are on lease.');
        }
    }







    public function destroy($vehicleId, $plate)
    {
        // Check if the car plate exists in the car_plates table
        $carPlate = CarPlate::where('plate', $plate)
            ->where('vehicles_id', $vehicleId)
            ->first();

        if (!$carPlate) {
            return redirect()->route('owner.vehicles.plates.index', $vehicleId)
                ->with('error', 'Car plate not found in car_plates.');
        }

        // Check if the car plate exists in the rental_plates table (including soft-deleted records)
        $rentalPlate = RentalPlate::where('plate', $plate)
            ->where('vehicle_id', $vehicleId)
            ->first();

        if (!$rentalPlate) {
            $vehicle = Vehicle::find($vehicleId);
            $inventory = $vehicle->inventory;

            // Decrement the quantity in the inventory
            $inventory->calculateQuantity(true); // Decrease the quantity by 1

            $carPlate->delete();

            return redirect()->route('owner.vehicles.plates.index', $vehicleId)
                ->with('success', 'Car plate deleted successfully.');
        } else {
            return redirect()->route('owner.vehicles.plates.index', $vehicleId)
                ->with('error', 'Car plates cannot be deleted because they are on lease.');
        }
    }



}
