<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Role;
use App\Models\User;
use App\Transformers\Json;
use App\Transformers\UserTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use League\Fractal\Serializer\ArraySerializer;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends Controller
{


    /**
     * @param LoginRequest $request
     * @return JsonResponse
     * user login api
     */
    public function login(Request $request): JsonResponse
    {


        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];


        if (!$token = auth()->attempt($data)) {
            return response()->json(Json::response(true, 'Invalid email and password'), 400);
        }

        $user = $request->user();

        $response = [
            'error' => false,
            'message' => 'Login successful',
            'user' => fractal()
                ->item($user, new UserTransformer($token))
                ->serializeWith(new ArraySerializer())
        ];

        return response()->json($response, 200, [], JSON_PRETTY_PRINT);

        //  return response()->json(Json::response(true, 'Invalid email and password'), 400);
    }


    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request)
    {

        $data = [
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ];

        $user = User::create($data);

        $role = Role::whereName($request->get('role'))->first();
        $user->roles()->attach($role);



        $response = [
            'error' => false,
            'message' => 'Registration successful',
            'user' => fractal()
                ->item($user, new UserTransformer())
                ->serializeWith(new ArraySerializer())
        ];

        return response()->json($response, 200, [], JSON_PRETTY_PRINT);

    }

    public function changePassword(Request $request)
    {

    }

    public function resetPassword(Request $request)
    {

    }


    public function logout()
    {

    }


}
