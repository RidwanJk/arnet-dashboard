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
            $denah = Map::all();
            return view('denah/index', ['denah' => $denah]);
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
            $fileName = $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/denah', $fileName, 'public');

        }

        $denah = new Map();
        $denah->name = $request->input('name');
        $denah->file = asset('storage/' . $filePath);
        $denah->save();

        return redirect()->to('/denah')->with('success', 'Denah STO berhasil disimpan.');
    }

    public function show(Map $map)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Map $denah)
    {
        if (session()->has('user_id')) {
            return view('denah.edit', ['denah' => $denah]);
        } else {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Map $map)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update the map with the new data
        $map->name = $request->input('name');

        // Handle the file upload if there is a new file
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('files', 'public');
            $map->file = $filePath;
        }

        // Save the updated map
        $map->save();

        // Redirect to the index page with a success message
        return redirect()->route('denah.index')->with('success', 'Denah updated successfully.');
    }

    public function destroy($id)
    {
        // Find the item by ID
        $denah = Map::find($id);

        if (!$denah) {
            return redirect()->route('viewdenah')->with('error', 'Item not found.');
        }

        // Delete the item
        $denah->delete();

        // Optionally, you can add a success message or redirect back
        return redirect()->route('viewdenah')->with('success', 'Item deleted successfully.');
    }




}
