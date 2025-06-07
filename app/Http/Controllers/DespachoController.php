<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DespachoController extends Controller
{
    /**
     * Display the despacho view.
     *
     * @return \Illuminate\View\View
     */
    public function despacho()
    {
        return view('despacho.despacho');
    }

    /**
     * Display the despacho moto view.
     *
     * @return \Illuminate\View\View
     */
    public function despachoMoto()
    {
        return view('despacho.despacho_moto');
    }
}
