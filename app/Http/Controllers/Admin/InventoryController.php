<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventory = Inventory::orderBy('created_at')->get();
        foreach ($inventory as $key => $value) {
            $inventory[$key]->satuan = $value->datasatuan->nama;
        }
        return Inertia::render('Warehouse/Inventory/index',['inventory' => $inventory]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $satuan = Satuan::all();
        return Inertia::render('Warehouse/Inventory/tambah',['satuan' => $satuan]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Inventory::create([
            'nama' => $request->nama,
            'satuan' => $request->satuan,
            'harga' => $request->harga,
        ]);
        return $this->index()->with('success','Inventory berhasil ditambahkan');
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
    public function edit(Inventory $inventory)
    {
        $satuan = Satuan::all();
        return Inertia::render('Warehouse/Inventory/edit',['satuan' => $satuan,'inventory' => $inventory]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Inventory $inventory)
    {
        $inventory->update([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'satuan' => $request->satuan,
        ]);
        return $this->index()->with('success','Inventory berhasil di ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        $inventory->delete();
        return $this->index()->with('warning','Data Inventory berhasil di hapus');
    }
}
