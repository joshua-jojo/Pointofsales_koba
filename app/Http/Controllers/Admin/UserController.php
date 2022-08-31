<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('System/user', ['user' => User::all(), 'role' => Role::all()]);
    }

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

        $data = $request->validate([
            'email' => ['required', 'max:50', 'email', 'unique:users'],
            'nama' => ['required', 'max:50'],
            'password' => ['required'],
            'username' => ['required', 'unique:users'],
            'role' => ['required'],
        ]);
        $data['password'] = bcrypt($data['password']);
        User::create($data);
        return $this->respon('success', 'User berhasil Ditambahkan');
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
    public function edit(User $user)
    { }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'email' => ['required', 'max:50', 'email'],
            'nama' => ['required', 'max:50'],
            'username' => ['required'],
            'role' => ['required'],
        ]);
        $role = Role::find($data['role'])->nama;
        $data['role'] = $role;
        if (request()->password != null) { 
            $data['password'] = bcrypt($request->password);
            $user->update($data);
        }
        else{
            $dataall= request()->all();
            $dataall['role'] = $role;
            $dataall['password'] = bcrypt($dataall['password']);
            $user->update($dataall);
        }
        return $this->respon('success','User berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return $this->respon('warning', 'User berhasil dihapus');
    }
    public function respon($type, $pesan)
    {
        return redirect()->route('systemuser.index')->with('alert', [
            "type" => $type,
            "message" => $pesan,
        ]);
    }
}
