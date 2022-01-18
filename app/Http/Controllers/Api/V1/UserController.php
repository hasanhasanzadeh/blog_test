<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\V1\UserCollection;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;


class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api',['except'=>['login','register','index']]);
    }

    /**
     * @return JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);

    }
    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request)
    {

        $data=[
          'email'=>$request->email,
          'password'=>$request->password
        ];

        if (! $token = JWTAuth::attempt($data) ){
            response()->json([
                'data'=>'Unauthorized',
                'status'=>'error'
            ],401);
        }
        return $this->respondWithToken($token);
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->api_token=Str::random(120);
        $user->save();

        return response()->json([
           'data'=>new UserResource($user),
           'status'=>'Registered Done!'
        ],200);
    }

    /**
     * @param $token
     * @return JsonResponse
     */
    private function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => config('jwt.ttl')
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function profile()
    {
            return response()->json(auth()->user());
    }

    public function index()
    {
        $users=User::paginate(10);
        return new UserCollection($users);
    }

}
