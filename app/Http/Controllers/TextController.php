<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TextController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            // Determine the file type
            $extension = $file->getClientOriginalExtension();

            if ($extension === 'json') {
                // Logic to handle JSON file
                $data = json_decode(file_get_contents($file), true);

                // Process the data as per your requirement
            } elseif ($extension === 'csv') {
                // Logic to handle CSV file
                $data = array_map('str_getcsv', file($file));

                // Process the data as per your requirement
            }

            // Perform any additional operations with the data

            return response()->json([
                'message' => 'File uploaded and processed successfully.',
                'data' => $data,
            ]);
        }

        return response()->json([
            'message' => 'No file found.',
        ], 400);
    }
}