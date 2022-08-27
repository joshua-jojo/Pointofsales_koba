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
        return Inertia::render('Master/meja',['meja' => meja::all()]);
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
            'nama' => ['required','min:2','unique:mejas'],
            'status' => ['required'],
        ]);
        $data['status'] = (string)$data['status'];
        try {
            meja::create($data);
            return $this->respon('success','Meja berhasil ditambahkan');
        } catch (\Throwable $th) {
            return $this->respon('danger','Meja gagal ditambahkan');
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
        $data = request()->validate([
            "status" => ['required']
        ]);
        $data['status'] = (string)$data['status'];
        try {
            $meja-> update($data);
            return $this->respon('success','Meja berhasil diedit');
        } catch (\Throwable $th) {
            return $this->respon('danger','Meja gagal diedit');
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
            return $this->respon('warning', 'Meja berhasil dihapus' );
        } catch (\Throwable $th) {
            return $this->respon('danger', 'Meja gagal dihapus' );
        }
    }
    public function respon($type, $pesan)
    {
        return redirect()->route('mastermeja.index')->with('alert', [
            "type" => $type,
            "message" => $pesan,
        ]);
    }
}
