<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class DocumentController extends Controller
{
    public function index()
    {

        if (session()->has('user_id')) {
            return view('surat/index');            
            // $document = Document::all();
            // return view('surat/index', ['surat' => $document]);
        } else {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
    }

    public function create()
    {

        if (session()->has('user_id')) {
            $user = User::find(session('user_id'));
            return view('surat/create', ['user' => $user]);
        } else {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
    }

    public function store(Request $request)
    {


        // Log::info('Store method called');
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|string|max:255',
        //     'type' => 'required|string|max:255',
        //     'brand' => 'required|string|max:255',
        //     'serial_number' => 'required|string|max:255',
        //     'sto' => 'required|string|max:255',
        // ]);

        // if (!$request->file('file')) {
        //     return redirect()->back()->with('fileError', 'Harap isi data semua data yang diperlukan')->withInput();
        // }

        // $validator->after(function ($validator) use ($request) {
        //     if ($request->file('file')->getClientOriginalExtension() !== 'vsd') {
        //         $validator->errors()->add('file', 'File harus bertipe .vsd');
        //     }
        // });


        // if ($validator->fails()) {
        //     Log::info('Validation failed');
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        // if ($request->file('file')) {
        //     Log::info('File upload detected');
        //     $file = $request->file('file');
        //     $fileName = $file->getClientOriginalName();
        //     $filePath = $file->storeAs('uploads/surat', $fileName, 'public');
        //     $convertedImagePath = $this->convertVsdToImage($filePath);
        //     Log::info('Converted image path: ' . $convertedImagePath);
        // }

        // $surat = new Document();
        // $surat->name = $request->input('name');
        // $surat->file = asset('storage/' . $filePath);
        // $surat->converted_image = asset($convertedImagePath);
        // $surat->save();

        // Log::info('surat saved');

        // Log::info('surat saved');

        // return redirect()->to('/surat')->with('success', 'surat STO berhasil disimpan.');
    }


    public function show(Document $Document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $surat)
    {
        if (session()->has('user_id')) {
            $surat = Document::find($surat->id);
            return view('surat.edit', ['surat' => $surat]);
        } else {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // $surat = Document::find($id);

        // if (!$surat) {
        //     return redirect()->back()->with('unusual', 'Ada error mohon ulangi lagi');
        // }

        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|string|max:255',
        //     'file' => 'nullable|file|max:2048'
        // ]);

        // if ($request->file('file') && $request->file('file')->getClientOriginalExtension() !== 'vsd') {
        //     $validator->after(function ($validator) {
        //         $validator->errors()->add('file', 'File harus bertipe .vsd');
        //     });
        // }

        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        // if ($request->file('file')) {
        //     if ($surat->file) {
        //         $oldFilePath = str_replace(asset('storage/'), '', $surat->file);
        //         Storage::disk('public')->delete($oldFilePath);
        //     }

        //     $file = $request->file('file');
        //     $fileName = $file->getClientOriginalName();
        //     $filePath = $file->storeAs('uploads/surat', $fileName, 'public');
        //     $convertedImagePath = $this->convertVsdToImage($filePath);
        //     $surat->file = asset('storage/' . $filePath);
        //     $surat->converted_image = asset($convertedImagePath);
        // }

        // $surat->name = $request->input('name');
        // $surat->save();

        // return redirect()->route('surat.index')->with('success', 'Data surat berhasil di update.');
    }

    public function destroy($id)
    {
        // Find the item by ID
        dd($id);
        $surat = Document::find($id);

        if (!$surat) {
            return redirect()->route('viewsurat')->with('errord', 'Item not found.');
        }

        // Delete the item
        $surat->delete();

        // Optionally, you can add a success message or redirect back
        return redirect()->route('viewsurat')->with('success', 'Item deleted successfully.');
    }

}
