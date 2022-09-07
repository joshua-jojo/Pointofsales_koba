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
        request()->validate([
            'pemesan' => 'required|min:3'
        ]);
        $data = [];
        $data_master = [];
        $totalfinal = $request->totalfinal;
        $namapemesan = $request->pemesan;
        $meja = $request->meja;
        $nama_meja = meja::find((int) $meja)->nama;
        $pesanan = request()->pesanan;
        foreach ($pesanan as $key => $value) {
            $taking_order = Kategori::where('nama', $value['kategori'])->first();
            $a = array(
                'id' =>  $value['id'],
                'nama' =>  $value['nama'],
                'jumlah' =>  $value['jumlah'],
                'harga' =>  $value['harga'],
                'total' =>  $value['total'],
                'kategori' =>  $value['kategori'],
                'taking_order' =>  $taking_order->taking_order,
                'keterangan' =>  $value['keterangan_pesan'],
                'meja' =>  $nama_meja,
            );
            $data = array($key => $a);
            $data_master = array_merge($data_master, $data);
        }
        $id_pemesanan = Pemesanan::create([
            'nama' => $namapemesan,
            'total' => $totalfinal,
            'meja' => $meja,
        ])->id;

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
        $master_diskon = Harga::find(2);
        $meja = meja::find($id);
        $data_produk = [];
        $produk = Produk::all();
        $data = [];
        foreach ($produk as $key => $value) {
            $master_produk = new stdClass;
            $master_produk->id = $value->id;
            $master_produk->nama = $value->nama;
            $master_produk->harga = $value->harga;
            $master_produk->satuan = $value->satuan->nama;
            $master_produk->stok = $value->stok;
            $master_produk->diskon = $value->diskon;
            $master_produk->kategori = $value->kategori->nama;
            $master_produk->keterangan = $value->keterangan;
            $master_produk->gambar = asset($value->gambar);
            array_push($data, $master_produk);
        }

        foreach ($data as $key => $value) {
            if ($master_diskon->value != 0) {
                $value->harga = $value->harga  - ($value->harga * $master_diskon->value / 100);;
            } else {
                $value->harga = $value->harga - ($value->harga * $value->diskon / 100);
            }
            $value->gambar = asset($value->gambar);
            $data_produk[$key] = $value;
        }
        return Inertia::render('Guest/standbyv2', ['produk' => $data_produk, 'kategori' => $kategori, 'meja' => $meja]);
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
        foreach ($data as $key => $value) {
            $gambar = Produk::find($value->id_produk)->gambar;
            $data[$key]->gambar = asset($gambar);
        }

        return Inertia::render('Guest/standby', ['pemesanan' => $data, 'id' => $id]);
        dd($data);
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
        $master_diskon = Harga::find(2);
        $data_produk = [];
        $produk = Produk::all();
        $data = [];
        foreach ($produk as $key => $value) {
            $master_produk = new stdClass;
            $master_produk->id = $value->id;
            $master_produk->nama = $value->nama;
            $master_produk->harga = $value->harga;
            $master_produk->satuan = $value->satuan->nama;
            $master_produk->stok = $value->stok;
            $master_produk->diskon = $value->diskon;
            $master_produk->kategori = $value->kategori->nama;
            $master_produk->keterangan = $value->keterangan;
            $master_produk->gambar = asset($value->gambar);
            array_push($data, $master_produk);
        }

        foreach ($data as $key => $value) {
            if ($master_diskon->value != 0) {
                $value->harga = $value->harga  - ($value->harga * $master_diskon->value / 100);;
            } else {
                $value->harga = $value->harga - ($value->harga * $value->diskon / 100);
            }
            $value->gambar = asset($value->gambar);
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
        $pesanan = request()->pesanan;
        $nama_meja = Pemesanan::find($id)->meja;
        $meja = meja::find($nama_meja)->nama;
        foreach ($pesanan as $key => $value) {
            $taking_order = Kategori::where('nama', $value['kategori'])->first();
            $a = array(
                'id' =>  $value['id'],
                'nama' =>  $value['nama'],
                'jumlah' =>  $value['jumlah'],
                'harga' =>  $value['harga'],
                'total' =>  $value['total'],
                'kategori' =>  $value['kategori'],
                'taking_order' =>  $taking_order->taking_order,
                'keterangan' =>  $value['keterangan_pesan'],
                'meja' =>  $nama_meja,
            );
            $data = array($key => $a);
            $data_master = array_merge($data_master, $data);
        }
        foreach ($data_master as $key => $value) {
            PemesananDetail::create([
                'id_pemesanan' => $id,
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
        return redirect()->route('pesan.edit', ['pesan' => $id]);
    }
}
