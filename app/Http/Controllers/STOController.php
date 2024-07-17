<?php

namespace App\Http\Controllers;
use App\Models\Dropdown;
use Illuminate\Http\Request;

class STOController extends Controller
{
    public function index()
    {
        $sto = Dropdown::where('type', 'sto')->get();
        return view('sto/index', ['stos' => $sto]);
    }
}
