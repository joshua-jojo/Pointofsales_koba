<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\meja;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MejaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Master/Meja/index',['meja' => meja::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Master/Meja/tambah');
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
            meja::create([
                'nama' => $request->nama,
                'status' => (string)$request->status,
            ]);
            return $this->index()->with('success','Meja berhasil ditambahkan');
        } catch (\Throwable $th) {
            return $this->index()->with('danger','Meja gagal ditambahkan');
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
    public function edit(meja $meja)
    {
        return Inertia::render('Master/Meja/edit',['meja' => $meja]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, meja $meja)
    {
        try {
            $meja-> update([
                'nama' => $request->nama,
                'status' => (string)$request->status,
            ]);
            return $this->index()->with('success','Meja berhasil diedit');
        } catch (\Throwable $th) {
            return $this->index()->with('danger','Meja gagal diedit');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(meja $meja)
    {
        try {
            $meja->delete();
            return $this->index()->with('warning', 'Meja berhasil dihapus' );
        } catch (\Throwable $th) {
            return $this->index()->with('danger', 'Meja gagal dihapus' );
        }
    }
}
