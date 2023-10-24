<?php

use App\Http\Controllers\Front\CatalogController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\DetailController;
use App\Http\Controllers\Front\LandingController;
use App\Http\Controllers\Front\OrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Owner\RegisterAdminController;
use App\Http\Controllers\Owner\RoleAdminController;
use App\Http\Controllers\Owner\VehiclePlateController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Owner\DashboardController as OwnerDashboardController;
use App\Http\Controllers\Owner\BrandController as OwnerBrandController;
use App\Http\Controllers\Owner\TypeController as OwnerTypeController;
use App\Http\Controllers\Owner\VehicleController as OwnerItemController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Owner\Owner\Front\PaymentController;

//use App\Http\Controllers\Driver\DashboardController as DriverDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::name('front.')->group(function () {
	Route::get('/', [LandingController::class, 'index'])->name('index');
    Route::get('/detail/{id}', [DetailController::class, 'index'])->name('detail');
    Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');
	Route::group(['middleware' => 'auth'], function () {
        Route::get('/checkout/{id}', [CheckoutController::class, 'index'])->name('checkout');
        Route::post('/checkout/{id}', [CheckoutController::class, 'store'])->name('checkout.store');
        Route::get('/checkout/send', function () {
            if (session()->has('checkout_completed')) {
                return view('success');
            }
        })->name('book.success');

        Route::get('/orders', [OrderController::class, 'index'])->name('orders');
	});
});

Route::prefix('owner')->name('owner.')->middleware([
	'auth:sanctum',
	config('jetstream.auth_session'),
	'verified',
	'admin'
])->group(function () {
	Route::get('/dashboard', [OwnerDashboardController::class, 'index'])->name('dashboard');
	Route::resource('brands', OwnerBrandController::class);
	Route::resource('types', OwnerTypeController::class);
	Route::resource('vehicles', OwnerItemController::class);
    Route::resource('vehicles', OwnerItemController::class);
    Route::delete('vehicles/{vehicle}/delete-photo/{id}', [OwnerItemController::class, 'deletePhoto'])->name('vehicles.deletePhoto');
    Route::resource('vehicles.plates', VehiclePlateController::class);
    Route::get('/register.admin', [RoleAdminController::class, 'index'])->name('register.admin');
    Route::post('/create-user-and-booking', [RegisterAdminController::class,'createUserAndBooking'])->name('create.admin');

});

Route::name('admin.')->middleware(['auth','role:ADMIN'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('bookings', AdminBookingController::class);
});




