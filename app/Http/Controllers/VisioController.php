<?php

namespace App\Http\Controllers;

use App\Services\VisioConverter;
use Illuminate\Http\Request;

class VisioController extends Controller
{
    protected $visioConverter;

    public function __construct(VisioConverter $visioConverter)
    {
        $this->visioConverter = $visioConverter;
    }

    public function preview(Request $request)
    {
        $request->validate([
            'vsd' => 'required|file|mimes:vsd',
        ]);

        $file = $request->file('vsd');
        $inputPath = $file->getPathname();
        $outputDir = storage_path('app/pdf');
        $outputPath = $outputDir . '/' . pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '.pdf';

        if (!is_dir($outputDir)) {
            mkdir($outputDir, 0755, true);
        }

        $this->visioConverter->convertToPdf($inputPath, $outputDir);

        if (file_exists($outputPath)) {
            return response()->file($outputPath);
        } else {
            return response()->json(['error' => 'Failed to convert VSD to PDF'], 500);
        }
    }
}
