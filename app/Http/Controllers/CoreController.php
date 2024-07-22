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
            if (
                !is_numeric($core->good) && $core->good == 0 &&
                !is_numeric($core->bad) && $core->bad == 0 &&
                !is_numeric($core->used) && $core->used == 0 &&
                !is_numeric($core->total) && $core->total == 0
            ) {
                continue;
            }

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

            $good = is_numeric($row[1]) ? $row[1] : 0;
            $bad = is_numeric($row[2]) ? $row[2] : 0;
            $used = is_numeric($row[3]) ? $row[3] : 0;
            $total = is_numeric($row[4]) ? $row[4] : 0;

            $processedData[] = [
                'segment' => $row[0],
                'good' => $good,
                'bad' => $bad,
                'used' => $used,
                'total' => $total,
            ];
        }

        DB::table('cores')->truncate();
        foreach ($processedData as $row) {
            Core::create([
                'segment' => $row['segment'],
                'good' => $row['good'],
                'bad' => $row['bad'],
                'used' => $row['used'],
                'total' => $row['total'],
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
