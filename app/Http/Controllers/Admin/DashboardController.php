<?php

namespace App\Http\Controllers\Owner\Owner\Admin;

use App\Http\Controllers\Owner\Owner\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
	public function index()
	{
		return view('admin.dashboard');
	}
}
