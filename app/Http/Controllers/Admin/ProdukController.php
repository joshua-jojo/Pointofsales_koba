<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;

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
        $kategori = Kategori::all();
        $satuan = Satuan::all();
        $produk = [];
        foreach ($data as $key => $value) {
            $produk[$key] = array(
                'id' => $value->id,
                'nama' => $value->nama,
                'harga' => $value->harga,
                'stok' => $value->stok,
                'diskon' => $value->diskon,
                'keterangan' => $value->keterangan,
                'satuan' => $value->satuan->nama,
                'gambar' => asset($value->gambar),
                'kategori' => $value->kategori->nama,
            );
        }
        return Inertia::render('Master/produk', ['produk' => $produk, 'kategori' => $kategori, 'satuan' => $satuan]);
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
        $request->validate([
            'nama' => ['required', 'min:3'],
            'diskon' => ['min:0', 'max:100', 'required', 'numeric'],
            'harga' => ['min:0', 'required', 'numeric'],
            'satuan' => ['required'],
            'kategori' => ['required'],
            'gambar' => ['required', 'mimes:jpg,png'],
        ]);

        try {
            if ($request->hasFile('gambar')) {
                $ekstensi = $request->file('gambar')->getClientOriginalExtension();
                $kategori  = Kategori::where('nama', $request->kategori)->first()->id;
                $satuan  = Satuan::where('nama', $request->satuan)->first()->id;
                $id = Produk::create([
                    'nama' => $request->nama,
                    'stok' => 0,
                    'diskon' => $request->diskon,
                    'harga' => $request->harga,
                    'keterangan' => $request->keterangan,
                    'id_satuan' => $satuan,
                    'id_kategori' => $kategori,
                ])->id;
                $namafile = $request->file('gambar')->getClientOriginalName();
                $filename = pathinfo($namafile, PATHINFO_FILENAME);
                $filenamesimpan = $filename . '_' . time() . '.' . $ekstensi;
                $filenamesimpandatabase = '/foto_produk/' . $filename . '_' . time() . '.' . $ekstensi;
                $path = $request->file('gambar')->move(public_path('foto_produk'), $filenamesimpan);
                Produk::find($id)->update([
                    'gambar' => $filenamesimpandatabase
                ]);
            }
            return $this->respon('success', 'Produk berhasil ditambahkan');
        } catch (\Throwable $th) {
            return $this->respon('danger', 'Produk gagal ditambahkan');
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
    { }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\s  $s
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produk $produk)
    {
        $request['nama'] = $request->data['nama'];
        $request['diskon'] = $request->data['diskon'];
        $request['harga'] = $request->data['harga'];
        $request['satuan'] = $request->data['satuan'];
        $request['kategori'] = $request->data['kategori'];
        $request->validate([
            'nama' => ['required', 'min:3'],
            'diskon' => ['min:0', 'max:100', 'required', 'numeric'],
            'harga' => ['min:0', 'required', 'numeric'],
            'satuan' => ['required'],
        ]);
        try {
            $kategori  = Kategori::where('nama', $request['kategori'])->first()->id;
            $satuan  = Satuan::where('nama', $request['satuan'])->first()->id;
            if ($request->hasFile('data')) {
                $ekstensi = $request->file('data')['gambar']->getClientOriginalExtension();
                $namafile = $request->file('data')['gambar']->getClientOriginalName();
                $filename = pathinfo($namafile, PATHINFO_FILENAME);
                $filenamesimpan = $filename . '_' . time() . '.' . $ekstensi;
                $filenamesimpandatabase = '/foto_produk/' . $filename . '_' . time() . '.' . $ekstensi;
                $path = $request->file('data')['gambar']->move(public_path('foto_produk'), $filenamesimpan);
                $produk->update([
                    'nama' => $request['data']['nama'],
                    'diskon' => $request['data']['diskon'],
                    'stok' => 0,
                    'harga' => $request['data']['harga'],
                    'keterangan' => $request['data']['keterangan'],
                    'id_satuan' => $satuan,
                    'id_kategori' => $kategori,
                    'gambar' => $filenamesimpandatabase,
                ]);
            } else {
                $produk->update([
                    'nama' => $request['data']['nama'],
                    'diskon' => $request['data']['diskon'],
                    'stok' => 0,
                    'harga' => $request['data']['harga'],
                    'keterangan' => $request['data']['keterangan'],
                    'id_satuan' => $satuan,
                    'id_kategori' => $kategori,
                ]);
            }
            return $this->respon('success', 'Produk berhasil diubah');
        } catch (\Throwable $th) {
            return $this->respon('danger', 'Produk gagal diubah');
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
            return $this->respon('warning', 'Produk berhasil dihapus');
        } catch (\Throwable $th) {
            return $this->respon('danger', 'Produk gagal dihapus');
        }
    }
    public function respon($type, $pesan)
    {
        return redirect()->route('masterproduk.index')->with('alert', [
            "type" => $type,
            "message" => $pesan,
        ]);
    }
}
