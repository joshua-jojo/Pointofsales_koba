<?php

namespace App\Http\Controllers;

use App\Models\meja;
use App\Models\Pemesanan;
use App\Models\PemesananDetail;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WaitressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pemesanan::where('status', 'aktif')->get();
        $array_pemesanan = [];
        foreach ($data as $key => $value) {
            $cek = PemesananDetail::where('id_pemesanan', $value->id)->get();
            $indicator = 0;
            foreach ($cek as $key => $status) {
                if ($status->status == "selesai") {
                    $indicator++;
                }
            }
            if ($indicator == count($cek)) {
                $data_meja = meja::find($value->meja)->nama;
            $value->meja = $data_meja;
                $data_pemesanan = array($value);
                $array_pemesanan = array_merge($array_pemesanan,$data_pemesanan);
            }
        }
        return Inertia::render('Waitress/transaksi', ['pemesanan_aktif' => $array_pemesanan]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($waitress)
    {
        $data = PemesananDetail::where('id_pemesanan', $waitress)->get();
        return Inertia::render('Waitress/transaksidetail', ['pemesanandetail' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
