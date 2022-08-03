<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pemasukkan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Transaksi/Pengeluaran/index',['pengeluaran' => Pengeluaran::orderBy('id','desc')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Transaksi/Pengeluaran/tambah');
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
            Pengeluaran::create([
                'nama' => $request->nama,
                'jumlah' => $request->jumlah,
                'harga' => $request->harga,
                'total' => $request->total,
                'keterangan' => $request->keterangan,
            ]);

            return $this->index()->with('success','Pengeluaran berhasil ditambahkan');
        } catch (\Throwable $th) {
            return $this->index()->with('danger','Pengeluaran gagal ditambahkan');
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
    public function edit(Pengeluaran $pengeluaran)
    {
        return Inertia::render('Transaksi/Pengeluaran/edit',['pengeluaran' => $pengeluaran]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengeluaran $pengeluaran)
    {
        try {
            $pengeluaran->update([
                'nama' =>$request->nama,
                'jumlah' =>$request->jumlah,
                'harga' =>$request->harga,
                'total' =>$request->total,
                'keterangan' =>$request->keterangan,
            ]);
            return $this->index()->with('success','Pengeluaran berhasil diubah');
        } catch (\Throwable $th) {
            return $this->index()->with('danger','Pengeluaran gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengeluaran $pengeluaran)
    {
        try {
            $pengeluaran->delete();
            return $this->index()->with('warning' ,'Pengeluaran berhasil dihapus');
        } catch (\Throwable $th) {
            return $this->index()->with('danger' ,'Pengeluaran gagal dihapus');
        }
    }
}
