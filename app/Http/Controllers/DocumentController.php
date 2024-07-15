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
        return view('surat/create', ['sto' => $sto, 'type' => $type]);
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
            'file' => 'required|mimes:pdf|max:2048'
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
    // DocumentController.php

    public function edit($id)
    {
        $surat = Document::find($id);
        $sto = Dropdown::where('type', 'sto')->get();
        $type = Dropdown::where('type', 'type')->get();
        return view('surat.edit', ['surat' => $surat, 'sto' => $sto, 'type' => $type]);
    }

    public function update(Request $request, $id)
    {
        $surat = Document::find($id);

        if (!$surat) {
            return redirect()->back()->with('error', 'Data surat tidak ditemukan.');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'type_id' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'serial' => 'required|string|max:255',
            'sto_id' => 'required|string|max:255',
            'file' => 'nullable|mimes:pdf|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->file('file')) {
            if ($surat->file) {
                Storage::disk('public')->delete($surat->file);
            }
            $file = $request->file('file');
            $filedata = file_get_contents($file);
            $fileName = $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/surat', $fileName, 'public');
            $surat->file = $filedata;
        }

        $surat->name = $request->input('name');
        $surat->type_id = $request->input('type_id');
        $surat->brand = $request->input('brand');
        $surat->serial = $request->input('serial');
        $surat->sto_id = $request->input('sto_id');
        $surat->save();

        return redirect()->route('document.index')->with('success', 'Data surat berhasil di update.');
    }


    public function destroy($id)
    {
        try {
            $document = Document::findOrFail($id);
            $document->delete();

            return redirect()->route('document.index')->with('success', 'Document deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('document.index')->with('errors', [$e->getMessage()]);
        }
    }
}
