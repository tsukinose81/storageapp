<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UploadController extends Controller
{
    public function file(Request $request)
    {
        // Log::debug($request->user()->user_id);
        $user_id = $request->user_id;
        $storage_name = $request->storage_name;
        
        if($request->user()->user_id == $user_id) {
            $file_name = $request->file->getClientOriginalName();
            $request->file->storeAs('public/' . $user_id . '/' . $storage_name, $file_name);
            return 'uploaded';
        }
        return 'permission error';
    }

    public function folder(Request $request)
    {
        Log::debug($request);
        // $file_name = $request->formData->file->getClientOriginalName();

        // $request->formData->file->storeAs('public/', $file_name);
        return 'uploaded';
    }
}
