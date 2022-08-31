<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pemasukkan;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PemasukkanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Transaksi/pemasukkan', ['pemasukkan' => Pemasukkan::all()]);
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
        try {
            Pemasukkan::create([
                'nama' => $request->nama,
                'jumlah' => $request->jumlah,
                'harga' => $request->harga,
                'total' => $request->total,
            ]);
            return $this->index()->with('success','Pemasukan berhasil ditambahkan');
        } catch (\Throwable $th) {
            return $this->index()->with('danger','Pemasukan gagal ditambahkan');
            //throw $th;
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
    public function edit(Pemasukkan $pemasukkan)
    {
        return Inertia::render('Transaksi/Pemasukkan/edit',['pemasukkan' => $pemasukkan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Pemasukkan $pemasukkan)
    {
        try {
            $pemasukkan->update([
                'nama' => $request->nama,
                'jumlah' => $request->jumlah,
                'harga' => $request->harga,
                'total' => $request->total,
            ]);
            return $this->index()->with('success','Pemasukkan berhasil diubah');
        } catch (\Throwable $th) {
            return $this->index()->with('danger','Pemasukkan gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pemasukkan $pemasukkan)
    {
        try {
            $pemasukkan->delete();
            return $this->index()->with('warning','Pemasukkan berhasil dihapus');
        } catch (\Throwable $th) {
            return $this->index()->with('danger','Pemasukkan berhasil dihapus');
        }
    }
}
