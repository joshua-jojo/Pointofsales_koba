<?php

namespace App\Http\Controllers;

use App\Models\meja;
use Illuminate\Http\Request;
use stdClass;

class CetakBarcodeController extends Controller
{
    public function cetakbarcode(Request $request,$id)
    {
        $data = explode(',',$id);
        $master = [];
        foreach ($data as $key => $value) {
            $data = new stdClass;
            $data->nama = meja::find($value)->nama;
            $data->url = url('pesan'.'/'.meja::find($value)->id);
            array_push($master,$data);
        }
        return view('barcode',['barcode' => $master]);
    }
}
