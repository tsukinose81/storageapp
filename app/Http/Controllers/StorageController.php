<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Storage;

class StorageController extends Controller
{
    public function create(Request $request)
    {
        // Log::debug($request);
        Storage::create([
            'user_id' =>  $request->user_id,
            'storage_name' => $request->storage_name,
            'public' => $request->public,
        ]);

        return response()->json(['message' => 'created']);
    }
}
