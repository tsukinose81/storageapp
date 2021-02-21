<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StorageController extends Controller
{
    public function storage_recent()
    {
        $storage_recent = \App\Models\Storage::orderBy('id', 'desc')->limit(10)->get();
        return $storage_recent;
    }

    public function create(Request $request)
    {
        // Log::debug($request);
        \App\Models\Storage::create([
            'user_id' =>  $request->user_id,
            'storage_name' => $request->storage_name,
            'public' => $request->public,
        ]);

        return response()->json(['message' => 'created']);
    }

    public function getfile(Request $request)
    {
        $user = $request->user_id;
        $storage = $request->storage_name;
        $directory = 'public/' . $user . '/' . $storage;

        $files = Storage::files($directory);
        $files_name = [];

        $i = 0;
        foreach ($files as $file) {
            $files_name[$i] = basename($file);
            $i++;
        }
        return $files_name;
    }
}
