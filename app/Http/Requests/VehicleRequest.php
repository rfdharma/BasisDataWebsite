<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class VehicleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'brand_id' => 'required|integer|exists:brands,id',
            'type_id' => 'required|integer|exists:types,id',
            'transmission' => 'nullable|string', // Add this rule for the 'transmission' field
            'price' => 'required|numeric',
            'capacity' => 'required|integer', // Add this rule for the 'capacity' field
            'features' => 'required|string|max:255',
            'photos' => 'nullable|array',
            'photos.*' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
            'year' => 'nullable|integer', // Add this rule for the 'year' field
        ];
    }
}
