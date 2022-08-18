<?php

namespace App\Http\Controllers;

use App\Models\Harga;
use App\Models\Pemasukkan;
use App\Models\Pemesanan;
use App\Models\PemesananDetail;
use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CashierTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pemesanan_aktif = Pemesanan::where('status', 'aktif')->get();
        $ppn = Harga::find(1)->value;
        foreach ($pemesanan_aktif as $key => $value) {
            $data_pemesanan = PemesananDetail::where('id_pemesanan', $value->id)->get();
            $total = 0;
            foreach ($data_pemesanan as $keys => $data) {
                $total+=$data->total;
            }
            $pemesanan_aktif[$key]->total = $total + ($total * $ppn/100);
        }
        foreach ($pemesanan_aktif as $key => $value) {
            $pemesanan_aktif[$key]->meja = $value->datameja->nama;
        }
        return Inertia::render('Cashier/transaksi', ['pemesanan_aktif' => $pemesanan_aktif]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $master_data = [];
        $id_data = 0 ;
        $id = [] ;
        foreach ($request->id as $key => $value) {
            $pemesanan = Pemesanan::find($value);
            array_push($id,$value);
            $pemesanan_detail = PemesananDetail::where('id_pemesanan', $pemesanan->id)->get();
            foreach ($pemesanan_detail as $key => $data) {
                if($id_data < $data->id_pemesanan){
                    $id_data = $data->id_pemesanan;
                }
                array_push($master_data, $data->toArray());
            }
        }
        $total = 0;
        foreach ($master_data as $key => $value) {
            $total = $total + $value['total'];
        }
        $ppn = Harga::find(1)->value;
        $master_data = array('data_pemesanan' => $master_data);
        $master_data['id_pemesanan'] = $id_data;
        $master_data['id'] = $id;
        $master_data['total'] = $total + ($ppn/100 * $total);
        // dd($master_data);
        return Inertia::render('Cashier/validate', ['pemesanandetail' => $master_data, 'total' => $total]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($cashiertransaksi)
    {
        $data = PemesananDetail::where('id_pemesanan', $cashiertransaksi)->get();
        return Inertia::render('Cashier/transaksidetail', ['pemesanandetail' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($cashiertransaksi)
    {
        $perusahaan = Setting::find(1)->nama;
        $pemesanan = Pemesanan::find($cashiertransaksi);
        $pemesanan_detail = PemesananDetail::where('id_pemesanan', $cashiertransaksi)->get();
        return view('struk', ['pemesanan' => $pemesanan, 'pemesanan_detail' => $pemesanan_detail, 'perusahaan' => $perusahaan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function cetak(Request $request)
    {
        // dd($request);
        foreach ($request->pemesanan['id'] as $key => $value) {
            Pemesanan::find($value)->update([
                'status' => 'finish'
            ]);
        }
        $total_keseluruhan = 0;
        foreach ($request['pemesanan']['data_pemesanan'] as $key => $value) {
            $total_keseluruhan+=$value['total'];
            Pemasukkan::create([
                'nama' => $value['nama'],
                'jumlah' => $value['jumlah'],
                'harga' => $value['harga'],
                'total' => $value['total'],
            ]);
        }
        $ppn = Harga::where('nama', 'ppn')->first();
        $perusahaan = Setting::find(1)->nama;
        return view('struk', [ 'pemesanan_detail' => $request, 'perusahaan' => $perusahaan,'ppn' => $ppn,'total_keseluruhan' => $total_keseluruhan]);
    }
}
