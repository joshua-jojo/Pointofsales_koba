<?php

namespace App\Http\Controllers;

use App\Models\Harga;
use App\Models\Kategori;
use App\Models\meja;
use App\Models\Pemesanan;
use App\Models\PemesananDetail;
use App\Models\Produk;
use Illuminate\Http\Request;
use Inertia\Inertia;
use stdClass;

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
        $produk = Produk::with(['satuan', 'kategori'])->get();
        $meja = meja::all();
        $master_diskon = Harga::find(2);
        $data_produk = [];
        foreach ($produk as $key => $value) {
            $produk[$key]->gambar = asset($value->gambar);
            if ($master_diskon->value != 0) {
                $value->harga = $value->harga  - ($value->harga * $master_diskon->value / 100);;
            } else {
                $value->harga = $value->harga - ($value->harga * $value->diskon / 100);
            }
        }
        foreach ($produk as $key => $value) {
            $value->id_kategori = $value->kategori->nama;
            $data_produk[$key] = $value;
        }
        $gambar = [];
        array_push($gambar, asset('img/dana.jpg'));
        array_push($gambar, asset('img/gopay.jpg'));
        array_push($gambar, asset('img/linkaja.jpg'));
        array_push($gambar, asset('img/ovo.jpg'));
        array_push($gambar, asset('img/qris.jpg'));
        array_push($gambar, asset('img/shopeepay.jpg'));
        return Inertia::render('Cashier/index', ['produk' => $data_produk, 'kategori' => $kategori, 'meja' => $meja,'gambar' => $gambar]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [];
        $data_master = [];
        $totalfinal = $request->totalfinal;
        $namapemesan = $request->namapemesan;
        $meja = $request->meja;
        $nama_meja = meja::find((int) $meja)->nama;
        foreach ($request->id as $key => $value) {
            foreach ($value as $keys => $data) {
                $taking_order = Kategori::where('nama', $request->kategori[$key][$keys]['nama'])->first();
                $a = array(
                    'id' =>  $request->id[$key][$keys],
                    'nama' =>  $request->nama[$key][$keys],
                    'jumlah' =>  $request->jumlah[$key][$keys],
                    'harga' =>  $request->harga[$key][$keys],
                    'total' =>  $request->total[$key][$keys],
                    'kategori' =>  $request->kategori[$key][$keys]['nama'],
                    'taking_order' =>  $taking_order->taking_order,
                    'keterangan' =>  $request->keterangan[$keys],
                    'meja' =>  $nama_meja,
                );
                $data = array($keys => $a);
                $data_master = array_merge($data_master, $data);
            }
        }
        $id_pemesanan = Pemesanan::create([
            'nama' => $namapemesan,
            'total' => $totalfinal,
            'meja' => $meja,
        ])->id;
        // dd($data_master);
        foreach ($data_master as $key => $value) {
            PemesananDetail::create([
                'id_pemesanan' => $id_pemesanan,
                'id_produk' => $value['id'],
                'nama' => $value['nama'],
                'jumlah' => $value['jumlah'],
                'harga' => $value['harga'],
                'total' => $value['total'],
                'keterangan' => $value['keterangan'],
                'meja' => $value['meja'],
                'progress' => $value['taking_order']
            ]);
        }
        meja::find($meja)->update([
            'status' => "1"
        ]);
        return $this->index();
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
