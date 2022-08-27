<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Satuan::all();
        return Inertia::render('Master/satuan',['satuan' => $data]);
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
            'nama' => ['required','unique:satuans']
        ]);
        try {
            satuan::create($data);
            return $this->respon('success','Satuan berhasil ditambahkan');
        } catch (\Throwable $th) {
            return $this->respon('danger','Satuan gagal ditambahkan');
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
    public function edit(Satuan $satuan)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Satuan $satuan)
    {
        
        try {
            $satuan->update(['nama' => $request->nama]);
            return $this->respon('success','Satuan berhasil diubah');
        } catch (\Throwable $th) {
            return $this->respon('danger','Satuan tidak dapat di ubah');
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Satuan $satuan)
    {
        try {
            $satuan->delete();
            return $this->respon('warning','Satuan berhasil dihapus!');
        } catch (\Throwable $th) {
            return $this->respon('danger','Satuan gagal dihapus!');
        }
    }
    public function respon($type, $pesan)
    {
        return redirect()->route('mastersatuan.index')->with('alert', [
            "type" => $type,
            "message" => $pesan,
        ]);
    }
}
