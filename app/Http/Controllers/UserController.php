<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
// use Auth;

use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\Factory;
// use Validator;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    // sign up users
    public function register(StorePostRequest $request)
    {

        $user = User::create(
            array_merge(

                $request->validated(),
                [

                    'password' => bcrypt($request->password),


                ]
            )

        );
        return response()->json(
            [
                'message' => "Utilisateur inserer avec succes",
                'user' => $user,

            ],
            201
        );
    }





    // try connect user
    public function login(Request $request)
    {
        $validateData = Validator::make(
            $request->all(),
            [
                'phone_number' => 'required|string',
                'password' => 'required|min:8',
            ]
        );

        if ($validateData->fails()) {
            return response()->json($validateData->errors(), 422);
        }
        if (!$token = auth()->attempt($validateData->validated())) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'email ou password incorrect'
                ],
                401
            );
        }
        return $this->respondWithToken($token);
    }


    // create token for users
    protected  function respondWithToken($token)
    {
        return response()->json([
            'user' => auth()->user(),
            'token_type' => 'bearer',
            'access_token' => $token,
            // 'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }



    // current user connected
    public function me()
    {
        return response()->json(auth()->user());
    }



    // logout user
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
