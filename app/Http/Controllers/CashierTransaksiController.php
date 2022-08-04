<?php

namespace App\Http\Controllers;

use App\Models\meja;
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
        
        $pemesanan = Pemesanan::find($request->id);
        $data_pemesanan = PemesananDetail::where('id_pemesanan',$request->id)->get();
        $pemesanan->update([
            'status' => 'finish',
            'bayar' => $request->bayar,
            'kembalian' => $request->kembalian,
        ]);
        meja::find($pemesanan->datameja->id)->update([
            'status' => "0"
        ]);

        foreach ($data_pemesanan as $key => $value) {
            Pemasukkan::create([
                'nama' => $value->nama,
                'jumlah' => $value->jumlah,
                'harga' => $value->harga,
                'total' => $value->total,
            ]);
        }
        return $this->edit($request->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($cashiertransaksi)
    {
        $data = PemesananDetail::where('id_pemesanan',$cashiertransaksi)->get();
        return Inertia::render('Cashier/transaksidetail',['pemesanandetail' => $data]);
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
        $pemesanan_detail = PemesananDetail::where('id_pemesanan',$cashiertransaksi)->get();
        return view('struk',['pemesanan' => $pemesanan,'pemesanan_detail' => $pemesanan_detail,'perusahaan' => $perusahaan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

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
}
