<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
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
        return Inertia::render('Transaksi/pengeluaran', ['pengeluaran' => Pengeluaran::orderBy('id', 'desc')->get()]);
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
        $data = request()->validate([
            'nama' => ['required', 'min:4'],
            'jumlah' => ['required', 'min:1', 'numeric'],
            'harga' => ['required', 'min:1', 'numeric'],
            'total' => ['required', 'min:1', 'numeric'],
            'keterangan' => ['required', 'min:4'],
        ]);
        try {
            Pengeluaran::create([
                'nama' => $request->nama,
                'jumlah' => $request->jumlah,
                'harga' => $request->harga,
                'total' => $request->total,
                'keterangan' => $request->keterangan,
            ]);

            return $this->respon('success','Pengeluaran berhasil ditambahkan');
        } catch (\Throwable $th) {
            return $this->respon('danger','Pengeluaran gagal ditambahkan');
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
        $data = request()->validate([
            'nama' => ['required', 'min:4'],
            'jumlah' => ['required', 'min:1', 'numeric'],
            'harga' => ['required', 'min:1', 'numeric'],
            'total' => ['required', 'min:1', 'numeric'],
            'keterangan' => ['required', 'min:4'],
        ]);
        try {
            $pengeluaran->update($data);
            return $this->respon('success','Pengeluaran berhasil diubah');
        } catch (\Throwable $th) {
            return $this->respon('danger','Pengeluaran gagal diubah');
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
            return $this->respon('warning', 'Pengeluaran berhasil dihapus');
        } catch (\Throwable $th) {
            return $this->respon('danger', 'Pengeluaran gagal dihapus');
        }
    }

    public function respon($type, $pesan)
    {
        return redirect()->route('transaksipengeluaran.index')->with('alert', [
            "type" => $type,
            "message" => $pesan,
        ]);
    }
}
