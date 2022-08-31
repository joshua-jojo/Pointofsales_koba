<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { }

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
            'id' => 'required',
            'jumlah' => 'required|min:1',
            'type' => 'required'
        ]);
        $inventory = Inventory::find($request->id);
        if ($data['type']  == 'pemasukkan') {
            $inventory->update([
                'stok' => ((int) $request->jumlah + $inventory->stok)
            ]);
        }
        else if ($data['type']  == 'pengeluaran') {
            $inventory->update([
                'stok' => ($inventory->stok - (int) $request->jumlah)
            ]);
        }
        return $this->respon('success', 'berhasil menambahkan inventory');
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
    { }

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
    public function respon($type, $pesan)
    {
        return redirect()->route('warehouseinventory.index')->with('alert', [
            "type" => $type,
            "message" => $pesan,
        ]);
    }
}
