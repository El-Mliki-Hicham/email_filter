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
            "yahoo",
"gmail",
"hotmail",
"aol",
"gmx",
"live",
"seznam",
"wanadoo",
"alice",
"outlook",
"orange",
"msn",
"libero",
"voila",
"mail",
"cox",
"comcast",
"freenet",
"sbcglobal",
"att",
"verizon",
"aim",
"t",
"web",
"free",
"abv",
"bol",
"rocketmail",
"terra",
"eyou",
"googlemail",
"gmailfe",
"cdtm",
"rambler",
"icloud",
"arcor",
"inbox",
"list",
"charter",
"sina",
"163",
"telenet",
"qq",
"uol"
        ];

        if ($file) {
            if ($file->getSize() > 0) {
                $lines = file($file->path(), FILE_IGNORE_NEW_LINES);
                $filteredData = [];       
                foreach ($lines as $line) {
                    $parts = explode('@', $line);
                    if (isset($parts[1])) {
                        $partsPoint = explode('.', $parts[1]);
                        if (isset($partsPoint[0]) && isset($partsPoint[1])) {
                            // $parts2 = explode(':', $partsPoint[1]);
                            $inArray = in_array($partsPoint[0], $domains);
                            if (!$inArray) {
                                $filteredData[] = $line;
                            }
                        }
                    }
                }
                $filename = 'filtered_data.txt';
                $filepath = storage_path('app/' . $filename);
                file_put_contents($filepath, implode(PHP_EOL, $filteredData));
                return response()->download($filepath, $filename)->deleteFileAfterSend(true);
            } else {
                return "File not found.";
            }
        }
    }

}
