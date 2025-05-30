<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CocinaController extends Controller
{
    /**
     * Display the cocina view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('cocina.cocina');
    }
}
