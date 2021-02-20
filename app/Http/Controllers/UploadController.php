<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UploadController extends Controller
{
    public function file(Request $request)
    {
        // Log::debug($request->header('Authorization'));
        // Log::debug($request->user());
        $file_name = $request->file->getClientOriginalName();
        $user_id = $request->user_id;
        $storage_name = $request->storage_name;
        $request->file->storeAs('public/' . $user_id . '/' . $storage_name, $file_name);
        return 'uploaded';
    }

    public function folder(Request $request)
    {
        Log::debug($request);
        // $file_name = $request->formData->file->getClientOriginalName();

        // $request->formData->file->storeAs('public/', $file_name);
        return 'uploaded';
    }
}
