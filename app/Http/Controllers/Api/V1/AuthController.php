<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\LoginRequest;
use App\Http\Requests\Api\V1\RegisterRequest;
use App\Http\Resources\Api\V1\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        UserResource::withoutWrapping();

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return response()->json([
            'user' => new UserResource($user),
            'token' => $user->createToken('auth_token')->plainTextToken,
        ]);
    }

    public function register(RegisterRequest $request)
    {
        UserResource::withoutWrapping();

        try {

            DB::beginTransaction();


            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);


            DB::commit();

            return response()->json([
                'user' => new UserResource($user),
                'token' => $user->createToken('auth_token')->plainTextToken,
            ]);
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 400);
        }
    }


    public function user(Request $request)
    {
        UserResource::withoutWrapping();

        $user = auth()->user()->load('empresaObj', 'roles', 'municipio:id,nombre');

        return response()->json([
            'user' => new UserResource($user),
            'token' => $request->bearerToken(),
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Se ha cerrado la sessión con éxito'], 204);
    }
}
