<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\meja;
use App\Models\Pemesanan;
use App\Models\PemesananDetail;
use App\Models\Produk;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $data = PemesananDetail::where('id_pemesanan', $id)->get();
        return Inertia::render('Guest/standby', ['pemesanan' => $data]);
    }

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
        // dd($request->totalfinal);
        foreach ($request->id as $key => $value) {
            foreach ($value as $keys => $data) {
                $a = array(
                    'id' =>  $request->id[$key][$keys],
                    'nama' =>  $request->nama[$key][$keys],
                    'jumlah' =>  $request->jumlah[$key][$keys],
                    'harga' =>  $request->harga[$key][$keys],
                    'total' =>  $request->total[$key][$keys],
                    'kategori' =>  $request->kategori[$key][$keys],
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
        $data_kategori = Kategori::all();

        foreach ($data_master as $key => $value) {
            if ($value['kategori'] == "Makanan") {
                PemesananDetail::create([
                    'id_pemesanan' => $id_pemesanan,
                    'id_produk' => $value['id'],
                    'nama' => $value['nama'],
                    'jumlah' => $value['jumlah'],
                    'harga' => $value['harga'],
                    'total' => $value['total'],
                    'meja' => $value['meja'],
                    'progress' => "cook"
                ]);
            } else {
                PemesananDetail::create([
                    'id_pemesanan' => $id_pemesanan,
                    'id_produk' => $value['id'],
                    'nama' => $value['nama'],
                    'jumlah' => $value['jumlah'],
                    'harga' => $value['harga'],
                    'total' => $value['total'],
                    'meja' => $value['meja'],
                    'progress' => "barista"
                ]);
            }
        }
        meja::find($meja)->update([
            'status' => "1"
        ]);
        return redirect()->route('pesan.edit', ['pesan' => $id_pemesanan]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kategori = Kategori::all();
        $produk = Produk::all();
        $meja = $id;
        $data_produk = [];

        foreach ($produk as $key => $value) {
            $value->id_kategori = $value->kategori->nama;
            $value->gambar = asset('storage'.$value->gambar);
            $data_produk[$key] = $value;
        }
        return Inertia::render('Guest/index', ['produk' => $data_produk, 'kategori' => $kategori, 'meja' => $meja]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = PemesananDetail::where('id_pemesanan', $id)->get();
        return Inertia::render('Guest/standby', ['pemesanan' => $data, 'id' => $id]);
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
    public function tambah($id)
    {
        $kategori = Kategori::all();
        $produk = Produk::all();
        $data_produk = [];

        foreach ($produk as $key => $value) {
            $value->id_kategori = $value->kategori->nama;
            $data_produk[$key] = $value;
        }
        return Inertia::render('Guest/tambah', ['produk' => $data_produk, 'kategori' => $kategori, 'id_pembelian' => $id]);
    }
    public function update_pesanan(Request $request, $id)
    {
        $data = [];
        $data_master = [];
        $totalfinal = $request->totalfinal;
        $namapemesan = $request->namapemesan;
        $nama_meja = Pemesanan::find($request->id_pembelian);
        // dd();
        // dd($request->totalfinal);
        foreach ($request->id as $key => $value) {
            foreach ($value as $keys => $data) {
                $a = array(
                    'id' =>  $request->id[$key][$keys],
                    'nama' =>  $request->nama[$key][$keys],
                    'jumlah' =>  $request->jumlah[$key][$keys],
                    'harga' =>  $request->harga[$key][$keys],
                    'total' =>  $request->total[$key][$keys],
                    'kategori' =>  $request->kategori[$key][$keys],
                    'meja' =>  $nama_meja->datameja->nama,
                );
                $data = array($keys => $a);
                $data_master = array_merge($data_master, $data);
            }
        }

        foreach ($data_master as $key => $value) {
            if ($value['kategori'] == "Makanan") {
                PemesananDetail::create([
                    'id_pemesanan' => $request->id_pembelian,
                    'id_produk' => $value['id'],
                    'nama' => $value['nama'],
                    'jumlah' => $value['jumlah'],
                    'harga' => $value['harga'],
                    'total' => $value['total'],
                    'meja' => $value['meja'],
                    'progress' => "cook"
                ]);
            } else {
                PemesananDetail::create([
                    'id_pemesanan' => $request->id_pembelian,
                    'id_produk' => $value['id'],
                    'nama' => $value['nama'],
                    'jumlah' => $value['jumlah'],
                    'harga' => $value['harga'],
                    'total' => $value['total'],
                    'meja' => $value['meja'],
                    'progress' => "barista"
                ]);
            }
        }
        return redirect()->route('pesan.edit', ['pesan' => $request->id_pembelian]);
    }
}
