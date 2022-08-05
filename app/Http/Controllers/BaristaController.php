<?php

namespace App\Http\Controllers;

use App\Models\PemesananDetail;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BaristaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pemesanan_aktif = PemesananDetail::where('progress', 'barista')->where('status', 'antri')->orWhere('status', 'diproses')->orderBy('id_pemesanan', 'asc')->get();

        // $pemesanan_aktif = Pemesanan::where('status', 'aktif')->get();
        // foreach ($pemesanan_aktif as $key => $value) {
        //     $data_pemesanan = PemesananDetail::where('id_pemesanan',$value->id)->get();
        //     foreach ($data_pemesanan as $key => $values) {
        //         if($values->progress == "cook"){
        //         }
        //     }
        // }
        return Inertia::render('Barista/index', ['pemesanan_aktif' => $pemesanan_aktif]);
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
    public function show($id)
    {
        //
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
