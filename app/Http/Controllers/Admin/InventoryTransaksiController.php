<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InventoryTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Inventory::all();
        $satuan = Satuan::all();
        return  Inertia::render('Warehouse/Inventory/tambahtransaksi', ['inventory' => $data, 'satuan' => $satuan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Inventory::all();
        $satuan = Satuan::all();
        return  Inertia::render('Warehouse/Inventory/tambahtransaksikeluar', ['inventory' => $data, 'satuan' => $satuan]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inventory = Inventory::find($request->id);
        $inventory->update([
            'stok' => ((int) $request->jumlah + $inventory->stok)
        ]);
        $inventory_page = new InventoryController;
        return $inventory_page->index()->with('success', 'berhasil menambahkan inventory');
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
     *@param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Inventory $inventorytransaksi)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventorytransaksi)
    {
        $inventorytransaksi->update([
            'stok' => ($inventorytransaksi->stok - (int) $request->jumlah)
        ]);
        $inventory_page = new InventoryController;
        return $inventory_page->index()->with('success', 'berhasil menambahkan pengeluaran inventory');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
