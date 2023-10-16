<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BookingRequest extends FormRequest
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
			'name' => 'nullable|string|max:255',
			'start_date' => 'nullable|date',
			'end_date' => 'nullable|date',
			'address' => 'nullable|string',
			'city' => 'nullable|string|max:255',
			'zip' => 'nullable|string|max:255',
			'status' => 'required|string|max:255',
//			'payment_method' => 'required|string|max:255',
//			'payment_status' => 'required|string|max:255',
//			'payment_url' => 'nullable|string|max:255',
            'status' => 'required|in:pending,confirmed,done,failed',
            'payment_status' => 'required|in:pending,success,failed',
            'return_status' => 'required|in:not returned,returned,expired',
			'total_price' => 'required|integer',
			'items_id' => 'required|integer|exists:items,id',
			'user_id' => 'required|integer|exists:users,id',
		];
	}
}
