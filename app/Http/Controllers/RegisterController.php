<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use \Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        /** @var Illuminate\Validation\Validator $validator */
        Log::debug($request);
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        User::create([
            'user_id' =>  $request->user_id,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        $user = User::whereEmail($request->email)->first();
        $user->tokens()->delete();
        $token = $user->createToken($user->user_id);
        $clientToken = $token->plainTextToken;
        Log::debug($clientToken);

        return $clientToken;
        // return response()->json('User registration completed', Response::HTTP_OK);
    }
}