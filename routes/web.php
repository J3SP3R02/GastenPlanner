<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Management
Route::get('/management', [\App\Http\Controllers\ManagementController::class, 'index']);
Route::delete('/management', [\App\Http\Controllers\WeddingController::class, 'destroy']);

Route::get('/create-wedding', function () {
    return view('wedding/create');
})->name('wedding.create');

Route::get('/forgot-password', function() {
    return view('auth/forgot-password');
})->middleware('guest')->name('password.request');

Route::get('/reset-password/{token}', function (string $token) {
    return view('auth/reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/create-wedding', [\App\Http\Controllers\WeddingController::class, 'store_pay']);

Route::get('mollie-payment',[App\Supports\Payment::class,'createPayment'])->name('mollie.payment');
Route::get('payment-success',[App\Http\Controllers\API\PaymentController::class, 'paymentSuccess'])->name('payment.success');

//Homepage requests
Route::get('/', [\App\Http\Controllers\WeddingController::class, 'index'])->name('homepage');
Route::post('/', [\App\Http\Controllers\WeddingController::class, 'store']);

//Login&Register requests
Route::get('/registreren', [\App\Http\Controllers\Auth\RegisterController::class, 'create']);
Route::post('/registreren', [\App\Http\Controllers\Auth\RegisterController::class, 'store']);

Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'create']);
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'authenticate']);

Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout']);


//Request password reset mail
Route::post('/forgot-password', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'passwordrequest'])
->middleware('guest')->name('password.email');

//Reset password
Route::post('/reset-password', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'passwordreset'])
->middleware('guest')->name('password.update');

Route::group(['prefix' => 'bruiloft/{unique_code}', 'middleware' => ['auth', 'wedding.access']], function () { //auth checks if logged in, wedding.access if the wedding is yours

    //Guestlist
    Route::get('/gastenlijst', [\App\Http\Controllers\GuestController::class, 'index']);
    Route::post('/gastenlijst', [\App\Http\Controllers\GuestController::class, 'store']);
    Route::put('/gastenlijst', [\App\Http\Controllers\GuestController::class, 'update']);
    Route::delete('/gastenlijst', [\App\Http\Controllers\GuestController::class, 'destroy']);

    //Guestlist Moment Welcome
    Route::put('/gastenlijst/welcome_role', [\App\Http\Controllers\GuestController::class, 'storeWelcome']);
    Route::post('/gastenlijst/welcome_role', [\App\Http\Controllers\GuestController::class, 'updateWelcome']);

    //Guestlist Export
    Route::get('/gastenlijst/export', [\App\Http\Controllers\GuestController::class, 'export']);

    //Location
    Route::get('/locatie', [\App\Http\Controllers\LocationController::class, 'index']);
    Route::post('/locatie', [\App\Http\Controllers\LocationController::class, 'store']);

    //Seating
    Route::get('/seating', [\App\Http\Controllers\SeatingController::class, 'index']);

    //Script
    Route::get('/draaiboek', [\App\Http\Controllers\ScriptController::class, 'index']);
    Route::post('/draaiboek', [\App\Http\Controllers\ScriptController::class, 'store']);

    //Cadeautips
    Route::get('/cadeautips', [\App\Http\Controllers\CadeautipsController::class, 'index']);
    Route::post('/cadeautips', [\App\Http\Controllers\CadeautipsController::class, 'getAccessToken']);


    //planner
    Route::get('/trouwplanner', [\App\Http\Controllers\PlannerController::class, 'index']);
});
