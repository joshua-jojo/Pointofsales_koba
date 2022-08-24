<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Inertia\Inertia;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategoridata = Kategori::all();
        return Inertia::render('Master/kategori', ['kategori' => $kategoridata]);
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
        try {
            Kategori::create([
                'nama' => $request->nama,
                'taking_order' => $request->taking_order
            ]);
        } catch (\Throwable $th) {
            return $this->index()->with('danger', 'Gagal menambahkan kategori');
        }
        return $this->index()->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Kategori $kategori)
    { }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategori $kategori)
    {
        return Inertia::render('Master/kategoriedit', ['kategori' => $kategori]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kategori $kategori)
    {
        try {
            $kategori->update([
                'nama' => $request->nama,
                'taking_order' => $request->taking_order
            ]);
        } catch (\Throwable $th) {
            return $this->index()->with('danger', 'Data telah tersedia. Data harus unik!');
        }
        return $this->index()->with('success', 'Data telah berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return $this->index()->with('warning', 'Data telah berhasil dihapus!');
    }
}
