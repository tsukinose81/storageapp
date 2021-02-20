<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function download(Request $request)
    {
        Log::debug($request);
        $file_name = $request->file;
        $path = 'public/' . $request->user_id . '/' . $request->storage_name . '/' . $file_name;
        
        $mime_type = Storage::mimeType($path);
        $headers = [[ 'Content-Type' => $mime_type ]];
        return Storage::download($path, $file_name, $headers);
    }
}
