<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Produk::all();
        $produk=[];
        foreach ($data as $key => $value) {
            $produk[$key] = array(
                'id' => $value->id,
                'nama' => $value->nama,
                'harga' => $value->harga,
                'stok' => $value->stok,
                'satuan' => $value->satuan->nama,
                'kategori' => $value->kategori->nama,
            );
        }
        return Inertia::render('Master/Produk/index',['produk' => $produk]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $satuan = Satuan::all();
        $kategori = Kategori::all();
        return Inertia::render('Master/Produk/tambah',['satuan' => $satuan,'kategori' => $kategori]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $kategori  = Kategori::where('nama',$request->kategori)->first()->id;
            $satuan  = Satuan::where('nama',$request->satuan)->first()->id;
            Produk::create([
                'nama' => $request->nama,
                'stok' => $request->stok,
                'harga' => $request->harga,
                'id_satuan' => $satuan,
                'id_kategori' => $kategori,
            ]);
            return $this->index()->with('success','Produk berhasil ditambahkan');
        } catch (\Throwable $th) {
            return $this->index()->with('danger','Produk gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\s  $s
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\s  $s
     * @return \Illuminate\Http\Response
     */
    public function edit(Produk $produk)
    {
        $data = $produk;
        
            $produk = array(
                'id' => $data->id,
                'nama' => $data->nama,
                'harga' => $data->harga,
                'stok' => $data->stok,
                'satuan' => $data->satuan->nama,
                'kategori' => $data->kategori->nama,
            );
        return Inertia::render('Master/Produk/edit',['produk' => $produk,'kategori' => Kategori::all(),'satuan' => Satuan::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\s  $s
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produk $produk)
    {
        try {
            $kategori  = Kategori::where('nama',$request->kategori)->first()->id;
            $satuan  = Satuan::where('nama',$request->satuan)->first()->id;
            $produk->update([
                'nama' => $request->nama,
                'stok' => $request->stok,
                'harga' => $request->harga,
                'id_satuan' => $satuan,
                'id_kategori' => $kategori,
            ]);
            return $this->index()->with('success','Produk berhasil diubah');
        } catch (\Throwable $th) {
            return $this->index()->with('danger','Produk gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\s  $s
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        try {
            $produk->delete();
            return $this->index()->with('warning','Produk berhasil dihapus');
        } catch (\Throwable $th) {
            return $this->index()->with('danger','Produk gagal dihapus');
        }
    }
}
