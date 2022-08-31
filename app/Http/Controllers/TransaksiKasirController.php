<?php

namespace App\Http\Controllers;

use App\Models\Harga;
use App\Models\meja;
use App\Models\Pemasukkan;
use App\Models\Pemesanan;
use App\Models\PemesananDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TransaksiKasirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pemesanan = Pemesanan::all();
        $master_pemesanan = [];
        foreach ($pemesanan as $key => $value) {
            if($value->cashier == null){
                unset($pemesanan[$key]);
            }
            else{
                $value->meja = meja::find($value->meja)->nama;
                $value->cashier = User::find($value->cashier)->nama;
                $data = PemesananDetail::where('id_pemesanan',$value->id)->get();
                $value['pesanan'] = $data;
                array_push($master_pemesanan,$value);
            }
        }
        // dd($master_pemesanan);
        return Inertia::render('Transaksi/kasir',['pemesanan' => $master_pemesanan]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pemasukkan  $pemasukkan
     * @return \Illuminate\Http\Response
     */
    public function show(Pemasukkan $pemasukkan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pemasukkan  $pemasukkan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pemasukkan $pemasukkan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pemasukkan  $pemasukkan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pemasukkan $pemasukkan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pemasukkan  $pemasukkan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pemasukkan $pemasukkan)
    {
        //
    }
}
