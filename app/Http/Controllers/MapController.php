<?php

namespace App\Http\Controllers;

use App\Models\Map;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

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
        Log::info('Store method called');
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'file' => 'required|file|max:2048'
        ]);

        if(!$request->file('file')){    
            return redirect()->back()->with('fileError', 'Harap isi data semua data yang diperlukan')->withInput();
        }
        
        $validator->after(function ($validator) use ($request) {
            if ($request->file('file')->getClientOriginalExtension() !== 'vsd') {
                $validator->errors()->add('file', 'File harus bertipe .vsd');
            }
        });
       

        if ($validator->fails()) {
            Log::info('Validation failed');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->file('file')) {
            Log::info('File upload detected');
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/denah', $fileName, 'public');
            $convertedImagePath = $this->convertVsdToImage($filePath);
            Log::info('Converted image path: ' . $convertedImagePath);
        }

        $denah = new Map();
        $denah->name = $request->input('name');
        $denah->file = asset('storage/' . $filePath);
        $denah->converted_image = asset($convertedImagePath);
        $denah->save();

        Log::info('Denah saved');

        Log::info('Denah saved');

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
            $denah = Map::find($denah->id);
            return view('denah.edit', ['denah' => $denah]);
        } else {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
    }

    public function convertVsdToImage($filePath)
    {
        $outputPath = storage_path('app/public/converted_images/' . pathinfo($filePath, PATHINFO_FILENAME) . '.png');
        $command = "soffice --headless --convert-to png --outdir " . escapeshellarg(dirname($outputPath)) . " " . escapeshellarg(storage_path('app/public/' . $filePath));
        $output = shell_exec($command . " 2>&1");

        Log::info("Conversion command: " . $command);
        Log::info("Conversion output: " . $output);

        if (file_exists($outputPath)) {
            Log::info("File exists: " . $outputPath);
            return 'storage/converted_images/' . basename($outputPath);
        } else {
            Log::error("File not found after conversion: " . $outputPath);
            return null;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $denah = Map::find($id);

        if(!$denah){
            return redirect()->back()->with('unusual', 'Ada error mohon ulangi lagi');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'file' => 'nullable|file|max:2048'
        ]);
    
        if ($request->file('file') && $request->file('file')->getClientOriginalExtension() !== 'vsd') {
            $validator->after(function ($validator) {
                $validator->errors()->add('file', 'File harus bertipe .vsd');
            });
        }
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        if ($request->file('file')) {
            if ($denah->file) {
                $oldFilePath = str_replace(asset('storage/'), '', $denah->file);
                Storage::disk('public')->delete($oldFilePath);
            }
    
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/denah', $fileName, 'public');
            $convertedImagePath = $this->convertVsdToImage($filePath);
            $denah->file = asset('storage/' . $filePath);
            $denah->converted_image = asset($convertedImagePath);
        }
    
        $denah->name = $request->input('name');
        $denah->save();

        return redirect()->route('denah.index')->with('success', 'Data denah berhasil di update.');
    }

    public function destroy($id)
    {
        // Find the item by ID
        dd($id);
        $denah = Map::find($id);

        if (!$denah) {
            return redirect()->route('viewdenah')->with('errord', 'Item not found.');
        }

        // Delete the item
        $denah->delete();

        // Optionally, you can add a success message or redirect back
        return redirect()->route('viewdenah')->with('success', 'Item deleted successfully.');
    }



}
