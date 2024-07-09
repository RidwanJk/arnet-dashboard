<?php

namespace App\Http\Controllers;

use App\Models\Map;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MapController extends Controller
{
    public function index()
    {
        if (session()->has('user_id')) {
            $user = User::find(session('user_id'));
            return view('denah/index', ['user' => $user]);
        } else {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
    }

    public function create()
    {

        if (session()->has('user_id')) {
            $user = User::find(session('user_id'));
            return view('denah/create', ['user' => $user]);
        } else {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'file' => 'required|file|max:2048'
        ]);

        $validator->after(function ($validator) use ($request) {
            if ($request->file('file')->getClientOriginalExtension() !== 'vsd') {
                $validator->errors()->add('file', 'The file must be a file of type: vsd.');
            }
        });

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->file('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/denah', $fileName, 'public');
        }
    
        $denah = new Map();
        $denah->name = $request->input('name');
        $denah->file = asset('storage/' . $filePath);
        $denah->save();

        return redirect()->to('denah')->with('success', 'Denah STO berhasil disimpan.');
    }

    public function show(Map $map)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Map $map)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Map $map)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Map $map)
    {
        //
    }
}
