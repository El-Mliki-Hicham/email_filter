<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class filter extends Controller
{
    //    function index(){
    //     return view('welcome');
    //    }

    function filter(Request $request)
    {
        $file = $request->file('fileText');
        $domains = [
            'yahoo',
            'gmail',
            'hotmail',
            'aol',
            'gmx',
            'live',
            'seznam',
            'wanadoo',
            'alice',
            'outlook',
            'orange',
            'msn',
            'libero',
            'voila',
            'mail',
        ];

        if ($file) {
            // Ensure the file is not empty
            if ($file->getSize() > 0) {
                // Read the file contents
                $lines = file($file->path(), FILE_IGNORE_NEW_LINES);
                $filteredData = [];

                foreach ($lines as $line) {
                    // Split each line by ":"
                    $parts = explode('@', $line);
                    $partsPoint = explode('.', $parts[1]);
                    $parts2 = explode(':', $partsPoint[1]);
                    $inArray = in_array($partsPoint[0], $domains);
                    if (!$inArray) {
                        $filteredData[] = $line;
                    }
                }

                // Generate a filename for the filtered data
                $filename = 'filtered_data.txt';
                $filepath = storage_path('app/' . $filename);

                // Write the filtered data to a file
                file_put_contents($filepath, implode(PHP_EOL, $filteredData));

                // Return a download response
                return response()->download($filepath, $filename)->deleteFileAfterSend(true);
            } else {
                return "File not found.";
            }
        }
    }

}
