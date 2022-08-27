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
        $data = request()->validate([
            'nama' => ['required','min:2','unique:kategoris'],
            'taking_order' => ['required'],
        ]);
        try {
            Kategori::create($data);
        } catch (\Throwable $th) {
            return $this->respon('danger', 'Gagal menambahkan kategori');
        }
        return $this->respon('success', 'Data berhasil ditambahkan!');
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
        $data = request()->validate([
            'taking_order' => ['required']
        ]);
        try {
            $kategori->update($data);
        } catch (\Throwable $th) {
            return $this->respon('danger', 'Kategori gagal di ubah!');
        }
        return $this->respon('success', 'Kategori telah berhasil diubah!');
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
        return $this->respon('warning', 'Data telah berhasil dihapus!');
    }
    public function respon($type, $pesan)
    {
        return redirect()->route('masterkategori.index')->with('alert', [
            "type" => $type,
            "message" => $pesan,
        ]);
    }
}
