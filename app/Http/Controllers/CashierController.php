<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\meja;
use App\Models\Pemesanan;
use App\Models\PemesananDetail;
use App\Models\Produk;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CashierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategori::all();
        $produk = Produk::all();
        $meja = meja::all();
        $data_produk=[];

        foreach ($produk as $key => $value) {
            $value->id_kategori = $value->kategori->nama;
            $data_produk[$key] = $value;
        }
        return Inertia::render('Cashier/index',['produk' => $data_produk,'kategori' => $kategori,'meja' => $meja]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id =[];
        $nama =[];
        $harga =[];
        $jumlah =[];
        $total =[];
        $totalfinal = $request->totalfinal;
        $namapemesan = $request->namapemesan;
        $meja = $request->meja;
        $id_pemesanan = Pemesanan::create([
            'nama' => $namapemesan,
            'total' => $totalfinal,
            'meja' => $meja,
        ])->id;
            
        foreach ($request->id as $key => $value) {
            foreach ($value as $keys => $data) {
                $id[$keys] = $data;
            }
        }
        
        foreach ($request->nama as $key => $value) {
            foreach ($value as $keys => $data) {
                $nama[$keys] = $data;
            }
        }
        foreach ($request->harga as $key => $value) {
            foreach ($value as $keys => $data) {
                $harga[$keys] = $data;
            }
        }
        foreach ($request->jumlah as $key => $value) {
            foreach ($value as $keys => $data) {
                $jumlah[$keys] = $data;
            }
        }
        foreach ($request->total as $key => $value) {
            foreach ($value as $keys => $data) {
                $total[$keys] = $data;
            }
        }

        foreach ($id as $key => $value) {
            PemesananDetail::create([
                'id_pemesanan' => $id_pemesanan,
                'id_produk' => $id[$key],
                'nama' => $nama[$key],
                'jumlah' => $jumlah[$key],
                'harga' => $harga[$key],
                'total' => $total[$key],
            ]);
        }

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
