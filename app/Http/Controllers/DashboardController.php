<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Pass any required data to the view
        return view('denah');
    }
    
    public function showForm()
    {
        // Pass any required data to the view
        return view('formdenah');
    }

}
