<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\BerandaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LoginController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $beranda = new BerandaController;
        $waitress = new WaitressController;
        $cook = new CookController;
        $cashier = new CashierController;
        $barista = new BaristaController;
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                return redirect()->route('beranda.index');
            } else if (Auth::user()->role == 'waitress') {
                return $waitress->index();
            } else if (Auth::user()->role == 'cook') {
                return $cook->index();
            } else if (Auth::user()->role == 'cashier') {
                return $cashier->index();
            } else if (Auth::user()->role == 'barista') {
                return $barista->index();
            }
        }
        return Inertia::render('Auth/login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Auth::logout();
        return $this->index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $beranda = new BerandaController;
        $waitress = new WaitressController;
        $cook = new CookController;
        $cashier = new CashierController;
        $auth = $request->only('username', 'password');
        Auth::attempt($auth);
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                return $beranda->index();
            } else if (Auth::user()->role == 'waitress') {
                return $waitress->index();
            } else if (Auth::user()->role == 'cook') {
                return $cook->index();
            } else if (Auth::user()->role == 'cashier') {
                return $cashier->index();
            }
        }
        return $this->index()->with('danger', 'Login gagal');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
