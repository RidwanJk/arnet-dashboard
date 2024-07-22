<?php

namespace App\Http\Controllers;

use App\Models\Core;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\DB;

class CoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cores = Core::all();

        $chartData = [];
        foreach ($cores as $core) {
            $chartData[] = [
                'ruas' => $core->segment,
                'good' => $core->good,
                'bad' => $core->bad,
                'used' => $core->used,
                'total' => $core->total,
            ];
        }

        return view('core.index', compact('chartData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('core.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'berita_acara' => 'required|mimes:xlsx,xls|max:2048',
        ]);

        $fileName = 'Core.' . $request->file('berita_acara')->getClientOriginalExtension();
        if (Storage::disk('public')->exists('core/' . $fileName)) {
            Storage::disk('public')->delete('core/' . $fileName);
        }
        $path = $request->file('berita_acara')->storeAs('core', $fileName, 'public');

        $spreadsheet = IOFactory::load(Storage::disk('public')->path('core/' . $fileName));
        $sheet = $spreadsheet->getSheetByName('Pivot');
        $data = $sheet->toArray();

        array_shift($data);

        $processedData = [];
        foreach ($data as $row) {
            if (empty($row[0]) || !is_string($row[0])) {
                break;
            }
            $processedData[] = $row;
        }

        DB::table('cores')->truncate();
        foreach ($processedData as $row) {
            Core::create([
                'segment' => $row[0],
                'good' => $row[1] ?? 0,
                'bad' => $row[2] ?? 0,
                'used' => $row[3] ?? 0,
                'total' => $row[4] ?? 0,
            ]);
        }

        return redirect()->route('core.index')->with('success', 'File successfully uploaded and data stored.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Core $core)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Core $core)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Core $core)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(core $core)
    {
        //
    }
}
