<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\DownloadController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user', function(Request $request){
        return $request->user();
    });
    Route::get('/user_id', function(Request $request){
        return $request->user()->user_id;
    });
    Route::post('/upload/folder', [UploadController::class, 'folder']);
});

Route::post('/storage/create', [StorageController::class, 'create']);
Route::get('/storage/getfile', [StorageController::class, 'getfile']);
Route::get('/download', [DownloadController::class, 'download']);
Route::post('/upload/file', [UploadController::class, 'file']);

Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::post('/register', [RegisterController::class, 'register']);
