<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Storage;

class UserPageController extends Controller
{
    public function storage_list(Request $request)
    {
        $storage_list = Storage::where('user_id', $request->user_id)->get();
        return $storage_list;
    }
}
