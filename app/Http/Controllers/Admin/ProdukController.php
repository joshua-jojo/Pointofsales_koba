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
        $produk = [];
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
        return Inertia::render('Master/Produk/index', ['produk' => $produk]);
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
            'diskon' => ['min:0', 'max:100', 'required'],
            'satuan' => ['required'],
            'kategori' => ['required'],
        ]);
        try {
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
            if ($request->hasFile('gambar')) {
                $ekstensi = $request->file('gambar')->getClientOriginalExtension();

                if ($ekstensi == 'png' or $ekstensi == 'jpg' or $ekstensi == 'JPG') {
                    $namafile = $request->file('gambar')->getClientOriginalName();
                    $filename = pathinfo($namafile, PATHINFO_FILENAME);
                    $filenamesimpan = $filename . '_' . time() . '.' . $ekstensi;
                    $filenamesimpandatabase = '/foto_produk/' . $filename . '_' . time() . '.' . $ekstensi;
                    $path = $request->file('gambar')->storeAs('/public/foto_produk', $filenamesimpan);
                    Produk::find($id)->update([
                        'gambar' => $filenamesimpandatabase
                    ]);
                }
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
        $request['nama'] = $request->form['nama'];
        $request['diskon'] = $request->form['diskon'];
        $request['satuan'] = $request->form['satuan'];
        $request['kategori'] = $request->form['kategori'];

        $request->validate([
            'nama' => ['required', 'min:3'],
            'diskon' => 'required|numeric|min:0|max:100',
        ]);
        try {
            $kategori  = Kategori::where('nama', $request['form']['kategori'])->first()->id;
            $satuan  = Satuan::where('nama', $request['form']['satuan'])->first()->id;
            if ($request->hasFile('form')) {
                $ekstensi = $request->file('form')['gambar']->getClientOriginalExtension();
                if ($ekstensi == 'png' or $ekstensi == 'jpg' or $ekstensi == 'JPG') {
                    $namafile = $request->file('form')['gambar']->getClientOriginalName();
                    $filename = pathinfo($namafile, PATHINFO_FILENAME);
                    $filenamesimpan = $filename . '_' . time() . '.' . $ekstensi;
                    $filenamesimpandatabase = '/foto_produk/' . $filename . '_' . time() . '.' . $ekstensi;
                    $path = $request->file('form')['gambar']->storeAs('/public/foto_produk', $filenamesimpan);
                    $produk->update([
                        'nama' => $request['form']['nama'],
                        'diskon' => $request['form']['diskon'],
                        'stok' => 0,
                        'harga' => $request['form']['harga'],
                        'keterangan' => $request['form']['keterangan'],
                        'id_satuan' => $satuan,
                        'id_kategori' => $kategori,
                        'gambar' => $filenamesimpandatabase,
                    ]);
                }
            } else {
                $produk->update([
                    'nama' => $request['form']['nama'],
                    'diskon' => $request['form']['diskon'],
                    'stok' => 0,
                    'harga' => $request['form']['harga'],
                    'keterangan' => $request['form']['keterangan'],
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
