<?php

namespace App\Http\Controllers;

use App\Models\Map;
use App\Http\Requests\UploadFileRequest;
use App\Http\Requests\UpdateFileRequest;
use App\Models\User;
use Illuminate\Http\Request;


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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('denah/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UploadFileRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
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



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the item by ID
        dd($id);
        $denah = Map::find($id);
        // Delete the item
        $denah->delete();

        // Optionally, you can add a success message or redirect back
        return redirect()->back()->with('success', 'Item deleted successfully.');
    }



}
