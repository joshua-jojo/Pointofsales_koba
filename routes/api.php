<?php

use App\Models\meja;
use App\Models\Pemesanan;
use App\Models\PemesananDetail;
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
Route::get('cook', function () {
    $pemesanan_aktif = PemesananDetail::where('progress', 'cook')->where('status', 'antri')->orWhere('status', 'diproses')->orderBy('id_pemesanan', 'asc')->get();
    return json_encode(['data' => $pemesanan_aktif]);
})->name('apicook');
Route::get('barista', function () {
    $pemesanan_aktif = PemesananDetail::where('progress', 'barista')->where('status', 'antri')->orWhere('status', 'diproses')->orderBy('id_pemesanan', 'asc')->get();
    return json_encode(['data' => $pemesanan_aktif]);
})->name('apibarista');
Route::get('waitress', function () {
    // $pemesanan_aktif = PemesananDetail::where('status', 'antri')->orWhere('status', 'diproses')->orderBy('id_pemesanan', 'asc')->get();
    // $data = Pemesanan::where('status', 'aktif')->get();
    // $array_pemesanan = [];
    // $array_pemesanan_detail = [];
    // foreach ($data as $key => $value) {
    //     $cek = PemesananDetail::where('id_pemesanan', $value->id)->get();
    //     $indicator = 0;
    //     foreach ($cek as $key => $status) {
    //         if ($status->status == "selesai" ) {
    //             if($status->waitress == 0){
    //                 $indicator++;
    //                 array_push($array_pemesanan_detail, $status);
    //             }
    //         }
    //     }
    //     if ($indicator == count($cek)) {
    //         $data_meja = meja::find($value->meja)->nama;
    //         $value->meja = $data_meja;
    //         $value['pesanan'] = $array_pemesanan_detail;
    //         $data_pemesanan = array($value);
    //         $array_pemesanan = array_merge($array_pemesanan, $data_pemesanan);
    //     }
    // }
    $data = Pemesanan::where('status', 'aktif')->get();
    $master_data = [];
    foreach ($data as $key => $pemesanan) {
        $cek = PemesananDetail::where('id_pemesanan', $pemesanan->id)->get();
        $counter = 0;
        foreach ($cek as $key => $value) {
            if ($pemesanan->id == $value->id_pemesanan) {
                if ($value->status == "selesai" and $value->waitress == 0) {
                    $counter = 0;
                } else {
                    $counter++;
                }
            }
        }
        if ($counter == 0) {
            $array_pemesanan = $pemesanan->toArray();
            $array_pemesanan['pesanan'] = $cek;
            array_push($master_data, $array_pemesanan);
        }
    }
    return json_encode(['data' => $master_data]);
})->name('apiwaitress');
Route::post('status/{id}/{data}', function ($id, $data) {
    $pemesanan = PemesananDetail::find($id);
    $pemesanan->update([
        'status' => $data
    ]);
})->name('cookstatus');
Route::post('update/{waitress}', function ($waitress) {
    $data = PemesananDetail::where('id_pemesanan', $waitress)->get();
    foreach ($data as $key => $value) {
        $value->update([
            'waitress' => "1"
        ]);
    }
})->name('waitressupdate');
Route::get('progress/{guest}', function ($guest) {
    $data = PemesananDetail::where('id_pemesanan', $guest)->get();
    return json_encode(['data' => $data]);
})->name('guestupdate');

Route::get('hapus/{id}', function ($id) {
    $data = PemesananDetail::find($id);
    $data->delete();
})->name('delete_data');
