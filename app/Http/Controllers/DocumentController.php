<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Dropdown;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class DocumentController extends Controller
{
    public function index()
    {         
        $document = Document::all();
        return view('surat/index', ['surat' => $document]);
    }

    public function create()
    {
        $user = User::find(session('user_id'));
        $sto = Dropdown::where('type', 'sto')->get();
        $type = Dropdown::where('type', 'type')->get();
        return view('surat/create', ['sto' => $sto, 'type'=>$type]);
    }

    public function store(Request $request)
    {
        Log::info('Store method called');
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'type_id' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'serial' => 'required|string|max:255',
            'sto_id' => 'required|string|max:255',
            'file'=> 'required|mimes:pdf|max:2048'
        ]);

        if (!$request->file('file')) {
            return redirect()->back()->with('fileError', 'Harap isi data semua data yang diperlukan')->withInput();
        }

        if ($validator->fails()) {
            Log::info('Validation failed');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Log::info('File upload detected');
        $file = $request->file('file');
        $filedata = file_get_contents($file);
        $fileName = $file->getClientOriginalName();
        $filePath = $file->storeAs('uploads/surat', $fileName, 'public');
        

        $surat = new Document();
        $surat->name = $request->input('name');
        $surat->type_id = $request->input('type_id');
        $surat->brand = $request->input('brand');
        $surat->serial = $request->input('serial');
        $surat->sto_id = $request->input('sto_id');
        $surat->file = $filedata;
        $surat->save();

        Log::info('surat saved');

        return redirect()->to('/document')->with('success', 'surat STO berhasil disimpan.');
    }


    public function show($id)
    {
        $document = Document::findOrFail($id);
        return response($document->file)
            ->header('Content-Type', 'application/pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $surat)
    {
        $surat = Document::find($surat->id);
        return view('surat.edit', ['surat' => $surat]);
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
