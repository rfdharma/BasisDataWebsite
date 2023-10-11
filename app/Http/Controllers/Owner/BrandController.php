<?php

namespace App\Http\Controllers\Owner;

use App\Models\Brand;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use App\Http\Requests\BrandRequest;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		// Script untuk Datatables, AJAX
		if (request()->ajax()) {
			$query = Brand::query();

			return DataTables::of($query)
				->addColumn('action', function ($brand) {
					return '
						<a class="block w-full px-2 py-1 mb-1 text-xs text-center text-white transition duration-500 bg-gray-700 border border-gray-700 rounded-md select-none ease hover:bg-gray-800 focus:outline-none focus:shadow-outline"
								href="' . route('owner.brands.edit', $brand->id) . '">
								Sunting
						</a>
						<form class="block w-full" onsubmit="return confirm(\'Apakah anda yakin?\');" -block" action="' . route('owner.brands.destroy', $brand->id) . '" method="POST">
						<button class="w-full px-2 py-1 text-xs text-white transition duration-500 bg-red-500 border border-red-500 rounded-md select-none ease hover:bg-red-600 focus:outline-none focus:shadow-outline" >
								Hapus
						</button>
								' . method_field('delete') . csrf_field() . '
						</form>';
				})
				->rawColumns(['action'])
				->make();
		}

		// Script untuk return halaman view brand
		return view('owner.brands.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('owner.brands.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(BrandRequest $request)
	{
		$data = $request->all();
		$data['slug'] = Str::slug($data['name']) . '-' . Str::lower(Str::random(5));

		Brand::create($data);

		return redirect()->route('owner.brands.index')->with('success', 'Brand berhasil ditambahkan');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Brand $brand)
	{
		return view('owner.brands.edit', [
			'brand' => $brand,
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(BrandRequest $request, Brand $brand)
	{
		$data = $request->all();
		$data['slug'] = Str::slug($data['name']) . '-' . Str::lower(Str::random(5));

		$brand->update($data);

		return redirect()->route('owner.brands.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Brand $brand)
	{
		$brand->delete();

		return redirect()->route('owner.brands.index');
	}
}
