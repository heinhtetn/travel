<?php

use App\Http\Controllers\AccomodationController;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\PoiController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TransportationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

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
// user start
Route::get('/', [UserController::class, 'index']);
Route::get('/user/poi', [UserController::class, 'show'])->name('user.poi');
Route::get('/user/poi/detail/{from}/{poi}', [UserController::class, 'detail'])->name('detail.poi');
Route::get('/user/transportation/{transportation}', [UserController::class, 'show_transportation'])->name('show.transport');
Route::get('/user/accomodation/{location}/{rating}', [UserController::class, 'show_accomodation'])->name('show.accomodation');
Route::get('/user/accomodation/{location}/{accomodation}/rooms', [UserController::class, 'show_rooms'])->name('show.rooms');
Route::get('/user/accomodation/{location}/{accomodation}/review', [UserController::class, 'accomodation_review'])->name('review.accomodations');
Route::post('/user/accomodation/{location}/{accomodation}/review', [UserController::class, 'create_accomodation_review'])->name('review.make');
Route::get('/user/transportation/{vehicle}/review', [UserController::class, 'vehicle_review'])->name('review.vehicles');
Route::post('/user/transportation/{vehicle}/review', [UserController::class, 'create_vehicle_review'])->name('review.create');
//user end

//navigation start
Route::get('/user/pointofinterests', [NavigationController::class, 'index'])->name('index.poi');
Route::get('/user/pointofinterests/detail/{poi}', [NavigationController::class, 'detail'])->name('poi.detail');
Route::get('/user/transportation', [NavigationController::class, 'show_transportation'])->name('transport.show');
Route::get('/user/transportation/detail/{transportation}', [NavigationController::class, 'detail_transportation'])->name('transport.detail');
Route::get('/user/hotels', [NavigationController::class, 'show_hotels'])->name('hotels.show');
Route::get('/user/{accomodation}/rooms', [NavigationController::class, 'show_rooms'])->name('rooms.show');

//navigation end

//admin start
Route::resource('/admin/poi', PoiController::class);

Route::resource('/admin/transportation', TransportationController::class);

Route::resource('/admin/accomodations', AccomodationController::class);

//vehicles
Route::get('admin/{transportation_id}/vehicles/', [VehicleController::class, 'index'])->name('vehicles.index');
Route::get('admin/{transportation_id}/vehicles/create', [VehicleController::class, 'create'])->name('vehicles.create');
Route::post('admin/{transportation_id}/vehicles/create', [VehicleController::class, 'store'])->name('vehicles.store');
Route::get('admin/{transportation}/vehicles/{vehicle}/edit', [VehicleController::class, 'edit'])->name('vehicles.edit');
Route::post('admin/{transportation}/vehicles/{vehicle}/edit', [VehicleController::class, 'update'])->name('vehicles.update');
Route::delete('admin/{transportation_id}/vehicles/{id}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');

//rooms
Route::get('admin/{accomodation}/rooms/', [RoomController::class, 'index'])->name('rooms.index');
Route::get('admin/{accomodation}/rooms/create', [RoomController::class, 'create'])->name('rooms.create');
Route::post('admin/{acomodation}/rooms/create', [RoomController::class, 'store'])->name('rooms.store');
Route::get('admin/{accomodation_id}/rooms/{room}/edit', [RoomController::class, 'edit'])->name('rooms.edit');
Route::post('admin/{accomodation_id}/rooms/{room}/edit', [RoomController::class, 'update'])->name('rooms.update');
Route::delete('admin/{accomodation_id}/rooms/{id}', [RoomController::class, 'destroy'])->name('rooms.destroy');
//admin end