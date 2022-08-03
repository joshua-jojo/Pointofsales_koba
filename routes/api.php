<?php

use App\Models\Pemesanan;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('settings', function () {
    return json_encode(Setting::all());
})->name('apisettings');
Route::get('pemesanan', function () {
    $data = Pemesanan::where('status', 'aktif')->get();
    $data = count($data);
    return json_encode(['data' => $data]);
})->name('apipemesanan');
