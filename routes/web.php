<?php

use App\Http\Controllers\AccomodationController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FacebookAuthController;
use App\Http\Controllers\GithubAuthContoller;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\PlanningnController;
use App\Http\Controllers\PoiController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TransportationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Two\FacebookProvider;


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
// auth
Route::group(['prefix' => 'auth'], function () {

    Route::get('/google', [GoogleAuthController::class, 'redirect'])->name('google-auth');
    Route::get('/google/call-back', [GoogleAuthController::class, 'callbackGoogle']);


    // github auth
    Route::get('/github', [GithubAuthContoller::class, 'redirect'])->name('github-auth');
    Route::get('/github/callback', [GithubAuthContoller::class, 'callbackGithub']);

    //facebook auth
    // Route::get('auth/facebook', [FacebookAuthController::class, 'redirect'])->name('facebook-auth');
    // Route::get('auth/facebook/callback', [FacebookAuthController::class, 'callbackFacebook']);
});

// user 
Route::get('/', [UserController::class, 'index'])->name('user.index');

Route::group(['prefix' => 'user'], function () {

    Route::get('/poi', [UserController::class, 'show'])->middleware(['auth', 'verified'])->name('user.poi');
    Route::get('/poi/detail/{from}/{poi}', [UserController::class, 'detail'])->name('detail.poi');
    Route::get('/transportation/{transportation}', [UserController::class, 'show_transportation'])->name('show.transport');
    Route::get('/accomodation/{location}/{rating}', [UserController::class, 'show_accomodation'])->name('show.accomodation');
    Route::get('/accomodation/{location}/{accomodation}/rooms', [UserController::class, 'show_rooms'])->name('show.rooms');
    Route::get('/accomodation/{location}/{accomodation}/review', [UserController::class, 'accomodation_review'])->name('review.accomodations');
    Route::post('/accomodation/{location}/{accomodation}/review', [UserController::class, 'create_accomodation_review'])->name('review.make')->middleware(['auth', 'verified']);
    Route::get('/transportation/{vehicle}/review', [UserController::class, 'vehicle_review'])->name('review.vehicles');
    Route::post('/transportation/{vehicle}/review', [UserController::class, 'create_vehicle_review'])->name('review.create')->middleware(['auth', 'verified']);
    //user end

    //navigation start
    Route::get('/pointofinterests', [NavigationController::class, 'index'])->name('index.poi');
    Route::get('/pointofinterests/detail/{poi}', [NavigationController::class, 'detail'])->name('poi.detail');
    Route::get('/transportation', [NavigationController::class, 'show_transportation'])->name('transport.show');
    Route::get('/transportation/detail/{transportation}', [NavigationController::class, 'detail_transportation'])->name('transport.detail');
    Route::get('/hotels', [NavigationController::class, 'show_hotels'])->name('hotels.show');
    Route::get('/{accomodation}/rooms', [NavigationController::class, 'show_rooms'])->name('rooms.show');
    Route::get('/blogs', [NavigationController::class, 'show_blogs'])->name('blogs.show');
    Route::get('/blogs/create', [NavigationController::class, 'new_blog'])->name('blogs.new');
    Route::post('/blogs/create', [NavigationController::class, 'create_blog'])->middleware(['auth', 'verified'])->name('blogs.create');
    Route::post('/blogs/search', [NavigationController::class, 'search'])->name('blogs.search');
    Route::get('/blogs/{blog}', [NavigationController::class, 'blog_detail'])->name('blogs.detail');
    Route::get('/contact', [NavigationController::class, 'show_contact'])->name('contact.show');
    Route::post('/contact', [NavigationController::class, 'send_email'])->middleware(['auth', 'verified'])->name('send.email');

    //navigation end
});

//planning
Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'planning'], function () {

    Route::get('/', [PlanningnController::class, 'index'])->name('plan.index');
    Route::get('/{from}', [PlanningnController::class, 'destination'])->name('plan.destination');
    Route::get('/{from}/{to}', [PlanningnController::class, 'choose'])->name('plan.choose');
    Route::get('/{from}/{to}/transportation', [PlanningnController::class, 'transport'])->name('plan.transport');
    Route::post('/{from}/{to}/transportation', [PlanningnController::class, 'transport'])->name('transport.plan');
    Route::get('/{from}/{to}/accomodation', [PlanningnController::class, 'accomodation'])->name('plan.hotel');
    Route::post('/{from}/{to}/accomodation', [PlanningnController::class, 'accomodation'])->name('hotel.plan');
    Route::get('/{from}/{to}/summary', [PlanningnController::class, 'summary'])->name('plan.summary');
    Route::get('/{from}/{to}/{transportation}', [PlanningnController::class, 'vehicle'])->name('plan.vehicle');
    Route::get('/{from}/{to}/{transportation}', [PlanningnController::class, 'vehicle'])->name('plan.vehicle');
    Route::get('/{from}/{to}/{accomodation}/rooms', [PlanningnController::class, 'room'])->name('plan.room');
});

//admin 
Route::group(['middleware' => ['auth', 'is_admin'],'prefix' => 'admin'], function () {
    
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::resource('/poi', PoiController::class);

    Route::resource('/transportation', TransportationController::class);

    Route::resource('/accomodations', AccomodationController::class);

    //vehicles
    Route::get('/{transportation}/vehicles/', [VehicleController::class, 'index'])->name('vehicles.index');
    Route::get('/{transportation_id}/vehicles/create', [VehicleController::class, 'create'])->name('vehicles.create');
    Route::post('/{transportation_id}/vehicles/create', [VehicleController::class, 'store'])->name('vehicles.store');
    Route::get('/{transportation}/vehicles/{vehicle}/edit', [VehicleController::class, 'edit'])->name('vehicles.edit');
    Route::post('/{transportation}/vehicles/{vehicle}/edit', [VehicleController::class, 'update'])->name('vehicles.update');
    Route::delete('/{transportation_id}/vehicles/{id}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');

    //rooms
    Route::get('/{accomodation}/rooms/', [RoomController::class, 'index'])->name('rooms.index');
    Route::get('/{accomodation}/rooms/create', [RoomController::class, 'create'])->name('rooms.create');
    Route::post('/{acomodation}/rooms/create', [RoomController::class, 'store'])->name('rooms.store');
    Route::get('/{accomodation_id}/rooms/{room}/edit', [RoomController::class, 'edit'])->name('rooms.edit');
    Route::post('/{accomodation_id}/rooms/{room}/edit', [RoomController::class, 'update'])->name('rooms.update');
    Route::delete('/{accomodation_id}/rooms/{id}', [RoomController::class, 'destroy'])->name('rooms.destroy');

    //accounts
    Route::get('/user_accounts', [AccountController::class, 'index'])->name('account.index');
    Route::post('/accounts/promote/{user}', [AccountController::class, 'promote_user'])->name('promote.user');
    Route::get('/accounts',[AccountController::class, 'account'])->name('account.admin');
    //admin end
});

Auth::routes(['verify' => true]);
