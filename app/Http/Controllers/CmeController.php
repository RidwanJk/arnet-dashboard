<?php

namespace App\Http\Controllers;

use App\Models\Cme;
use Illuminate\Http\Request;

class CmeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
                
        return view('cme.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cme.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cme $cme)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cme $cme)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cme $cme)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cme $cme)
    {
        //
    }
}
