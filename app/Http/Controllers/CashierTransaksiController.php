<?php

namespace App\Http\Controllers;

use App\Models\Harga;
use App\Models\meja;
use App\Models\Pemasukkan;
use App\Models\Pemesanan;
use App\Models\PemesananDetail;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CashierTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $pemesanan_aktif = Pemesanan::where('status', 'aktif')->get();
        $ppn = Harga::find(1)->value;
        $master_data = [];
        foreach ($pemesanan_aktif as $key => $value) {
            $data_pemesanan = PemesananDetail::where('id_pemesanan', $value->id)->get();
            $total = 0;

            foreach ($data_pemesanan as $keys => $data) {
                if ($data->status == 'habis') {
                    unset($data);
                } else {
                    $total += $data->total;
                }
            }
            $pemesanan_aktif[$key]->total = $total + ($total * $ppn / 100);
        }
        foreach ($pemesanan_aktif as $key => $value) {
            if ($value->total == 0) {
                unset($pemesanan_aktif[$key]);
            } else {
                array_push($master_data, $value);
                $pemesanan_aktif[$key]->meja = $value->datameja->nama;
            }
        }

        return Inertia::render('Cashier/transaksi', ['pemesanan_aktif' => $master_data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $master_data = [];
        $id_data = 0;
        $id = [];
        foreach ($request->id as $key => $value) {
            $pemesanan = Pemesanan::find($value);
            array_push($id, $value);
            $pemesanan_detail = PemesananDetail::where('id_pemesanan', $pemesanan->id)->get();
            foreach ($pemesanan_detail as $key => $data) {

                if ($id_data < $data->id_pemesanan) {
                    $id_data = $data->id_pemesanan;
                }
                if ($data->status == 'habis') {
                    unset($pemesanan_detail[$key]);
                } else {
                    array_push($master_data, $data->toArray());
                }
            }
        }
        $total = 0;
        foreach ($master_data as $key => $value) {
            $total = $total + $value['total'];
        }
        $ppn = Harga::find(1)->value;
        $master_data = array('data_pemesanan' => $master_data);
        $master_data['id_pemesanan'] = $id_data;
        $master_data['id'] = $id;
        $master_data['total'] = $total + ($ppn / 100 * $total);
        // dd($master_data);
        return Inertia::render('Cashier/validate', ['pemesanandetail' => $master_data, 'total' => $total]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($cashiertransaksi)
    {

        $data = PemesananDetail::where('id_pemesanan', $cashiertransaksi)->get();
        $master_data = [];
        foreach ($data as $key => $value) {
            if ($value->status == 'habis') {
                unset($data[$key]);
            } else {
                array_push($master_data, $value);
            }
        }
        return Inertia::render('Cashier/transaksidetail', ['pemesanandetail' => $master_data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($cashiertransaksi)
    {
        $perusahaan = Setting::find(1)->nama;
        $pemesanan = Pemesanan::find($cashiertransaksi);
        $pemesanan_detail = PemesananDetail::where('id_pemesanan', $cashiertransaksi)->get();
        return view('struk', ['pemesanan' => $pemesanan, 'pemesanan_detail' => $pemesanan_detail, 'perusahaan' => $perusahaan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { }

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

    public function cetak(Request $request)
    {
        if (request()->ref == null) {
            request()->ref = '-';
        }
        foreach ($request->id as $key => $value) {
            Pemesanan::find($value)->update([
                'status' => 'finish',
                'referensi' => request()->ref,
                'cashier' => Auth::user()->id
            ]);
            foreach ($request->meja as $key => $value) {
                $data = meja::with(['pemesanan'])->find($value);
                if (count($data->pemesanan) == 0) {
                    $data->update([
                        'status' => '0'
                    ]);
                }
            }
        }
        if (count(request()->id) > 0) {
            $n = 0;
            $master = '';
            foreach (request()->id as $key => $data) {
                if ($n == 0) {
                    $master = $master . $data;
                } else {
                    $master = $master . ',' . (string) $data;
                }
                $n++;
            }
            $request['id'] = $master;
        }

        $total_keseluruhan = 0;
        foreach ($request->produk as $key => $value) {
            $total_keseluruhan += $value['total'];
            Pemasukkan::create([
                'nama' => $value['nama'],
                'jumlah' => $value['jumlah'],
                'harga' => $value['harga'],
                'total' => $value['total'],
            ]);
        }
        $ppn = Harga::where('nama', 'ppn')->first()->value;
        $ppn = $total_keseluruhan * ($ppn / 100);
        $perusahaan = Setting::find(1)->nama;
        if (request()->ref == null) {
            request()->ref = '-';
        }
        return view('struk', ['pemesanan_detail' => $request, 'perusahaan' => $perusahaan, 'ppn' => (int) $ppn, 'total_keseluruhan' => $total_keseluruhan]);
    }
}
