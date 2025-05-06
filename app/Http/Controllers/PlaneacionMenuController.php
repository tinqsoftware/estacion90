<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlaneacionMenuController extends Controller
{
    public function menusemanal()
    {
        return redirect()->route('menu.menu_semana');
    }
}
