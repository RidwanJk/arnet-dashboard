<?php

namespace App\Http\Controllers;

use App\Models\Map;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Services\VisioConverter;


class MapController extends Controller
{
    protected $visioConverter;
    public function __construct(VisioConverter $visioConverter)
    {
        $this->visioConverter = $visioConverter;
    }

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

        if(!$request->file('file')){
            return redirect()->back()->with('fileError', 'Harap isi file yang ingin dimasukkan.')->withInput();
        }
        
        $validator->after(function ($validator) use ($request) {
            if ($request->file('file')->getClientOriginalExtension() !== 'vsd') {
                $validator->errors()->add('file', 'File harus bertipe .vsd');
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
            $denah->file = asset('storage/' . $filePath);
        }
    
        $denah->name = $request->input('name');
        $denah->save();

        return redirect()->route('denah.index')->with('success', 'Data denah berhasil di update.');
    }

    public function destroy($id)
    {
        // Find the item by ID        
        $denah = Map::find($id);

        if (!$denah) {
            return redirect()->route('viewdenah')->with('errord', 'Item not found.');
        }

        // Delete the item
        $denah->delete();

        // Optionally, you can add a success message or redirect back
        return redirect()->route('viewdenah')->with('success', 'Item deleted successfully.');
    }

    public function preview($id)
    {
        $denah = Map::findOrFail($id);        
        $filePath = str_replace(asset('storage/'), '', $denah->file);        
        $inputPath = storage_path($filePath);
        

        
        $outputDir = storage_path('app/pdf');
        $outputPath = $outputDir . '/' . pathinfo($denah->name, PATHINFO_FILENAME) . '.pdf';

        // Ensure output directory exists
        if (!is_dir($outputDir)) {
            mkdir($outputDir, 0755, true);
        }

        // Check if input file exists
        if (!file_exists($inputPath)) {
            return response()->json(['error' => 'Input file not found'], 404);
        }

        // Command to convert VSD to PDF using LibreOffice
        $command = "soffice --headless --convert-to pdf \"$inputPath\" --outdir \"$outputDir\"";

        // Execute the command
        exec($command, $output, $return_var);

        // Check if the command was successful
        return response()->file($outputPath);
    }
}
