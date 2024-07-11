<?php

namespace App\Services;

class VisioConverter
{
    public function convertToPdf($inputPath, $outputPath)
    {
        $command = "soffice --headless --convert-to pdf \"$inputPath\" --outdir \"$outputPath\"";
        exec($command);
    }
}
