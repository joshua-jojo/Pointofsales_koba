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
        return Inertia::render('Master/Satuan/index',['satuan' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Master/Satuan/tambah');
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
            satuan::create([
                'nama' => $request->nama
            ]);
            return $this->index()->with('success','Satuan berhasil ditambahkan');
        } catch (\Throwable $th) {
            return $this->index()->with('danger','Satuan gagal ditambahkan');
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
        // dd($satuan);
        return Inertia::render('Master/Satuan/edit',['satuan' => $satuan]);
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
            return $this->index()->with('success','Satuan berhasil diubah');
        } catch (\Throwable $th) {
            return $this->index()->with('danger','Satuan tidak dapat di ubah');
            
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
            return $this->index()->with('warning','Satuan berhasil dihapus!');
        } catch (\Throwable $th) {
            return $this->index()->with('danger','Satuan gagal dihapus!');
        }
    }
}
