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
        return Inertia::render('Master/Produk/index', ['produk' => $produk, 'kategori' => $kategori, 'satuan' => $satuan]);
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
        return Inertia::render('Master/Produk/tambah', ['satuan' => $satuan, 'kategori' => $kategori]);
    }

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
            return $this->index()->with('success', 'Produk berhasil ditambahkan');
        } catch (\Throwable $th) {
            return $this->index()->with('danger', 'Produk gagal ditambahkan');
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
            'diskon' => $data->diskon,
            'satuan' => $data->satuan->nama,
            'kategori' => $data->kategori->nama,
            'keterangan' => $data->keterangan,
        );
        return Inertia::render('Master/Produk/edit', ['produk' => $produk, 'kategori' => Kategori::all(), 'satuan' => Satuan::all()]);
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
        $request['nama'] = $request->formedit['nama'];
        $request['diskon'] = $request->formedit['diskon'];
        $request['harga'] = $request->formedit['harga'];
        $request['satuan'] = $request->formedit['satuan'];
        $request['kategori'] = $request->formedit['kategori'];
        $request->validate([
            'nama' => ['required', 'min:3'],
            'diskon' => ['min:0', 'max:100', 'required', 'numeric'],
            'harga' => ['min:0', 'required', 'numeric'],
            'satuan' => ['required'],
            'kategori' => ['required'],
        ]);
        try {
            $kategori  = Kategori::where('nama', $request['kategori'])->first()->id;
            $satuan  = Satuan::where('nama', $request['satuan'])->first()->id;
            if ($request->hasFile('formedit')) {
                $ekstensi = $request->file('formedit')['gambar']->getClientOriginalExtension();
                $namafile = $request->file('formedit')['gambar']->getClientOriginalName();
                $filename = pathinfo($namafile, PATHINFO_FILENAME);
                $filenamesimpan = $filename . '_' . time() . '.' . $ekstensi;
                $filenamesimpandatabase = '/foto_produk/' . $filename . '_' . time() . '.' . $ekstensi;
                $path = $request->file('formedit')['gambar']->move(public_path('foto_produk'), $filenamesimpan);
                $produk->update([
                    'nama' => $request['formedit']['nama'],
                    'diskon' => $request['formedit']['diskon'],
                    'stok' => 0,
                    'harga' => $request['formedit']['harga'],
                    'keterangan' => $request['formedit']['keterangan'],
                    'id_satuan' => $satuan,
                    'id_kategori' => $kategori,
                    'gambar' => $filenamesimpandatabase,
                ]);
            } else {
                $produk->update([
                    'nama' => $request['formedit']['nama'],
                    'diskon' => $request['formedit']['diskon'],
                    'stok' => 0,
                    'harga' => $request['formedit']['harga'],
                    'keterangan' => $request['formedit']['keterangan'],
                    'id_satuan' => $satuan,
                    'id_kategori' => $kategori,
                ]);
            }
            return $this->index()->with('success', 'Produk berhasil diubah');
        } catch (\Throwable $th) {
            return $this->index()->with('danger', 'Produk gagal diubah');
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
            return $this->index()->with('warning', 'Produk berhasil dihapus');
        } catch (\Throwable $th) {
            return $this->index()->with('danger', 'Produk gagal dihapus');
        }
    }
}
