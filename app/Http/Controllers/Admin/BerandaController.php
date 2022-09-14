<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Bulan;
use App\Models\Kategori;
use App\Models\Pemasukkan;
use App\Models\Pengeluaran;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class BerandaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bulan = Bulan::all();
        $nama_bulan = [];
        $pemasukkan = Pemasukkan::all();
        $pengeluaran = Pengeluaran::all();
        $data_pemasukkan = [];
        $data_pengeluaran = [];
        foreach ($bulan as $key => $value) {
            array_push($nama_bulan, $value->nama);
        }

        $bulan = [
            '01','02','03','04','05','06','07','08','09','10','11','12'
        ];
        foreach ($bulan as $key => $value) {
            $total = 0;
            foreach ($pemasukkan as $key => $data) {
                if($value == $data->created_at->format('m') && $data->created_at->format('Y') == date('Y')){
                    $total+=$data->total;
                }
            }
            array_push($data_pemasukkan, $total);
            $total = 0;
            foreach ($pengeluaran as $key => $data) {
                if($value == $data->created_at->format('m') && $data->created_at->format('Y') == date('Y')){
                    $total+=$data->total;
                }
            }
            array_push($data_pengeluaran, $total);
        }
        $produk  = count(Produk::all());
        $kategori  = count(Kategori::all());
        $transaksi_pemasukan  = count(Pemasukkan::all());
        $transaksi_pengeluaran  = count(Pengeluaran::all());
        $user = Auth::user()->nama;
        return Inertia::render('Beranda/beranda', ['bulan' => $nama_bulan,'data_pemasukkan' => $data_pemasukkan,'data_pengeluaran' => $data_pengeluaran,'transaksi_pengeluaran' => $transaksi_pengeluaran,'transaksi_pemasukkan' => $transaksi_pemasukan,'kategori'=>$kategori,'produk'=>$produk,'user' => $user]);
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
