<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeUserRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Resources\V1\UserCollection;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;


class UserController extends Controller
{

    /**
     * middleware api excepted login and register and index
     */
    public function __construct()
    {
        $this->middleware('auth:api',['except'=>['login','register']]);
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
    public function register(RegisterRequest $request)
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

    /**
     * @return UserCollection
     */
    public function index()
    {
        $users=User::paginate(10);
        return new UserCollection($users);
    }

    /**
     * @param UserStoreRequest $reqest
     * @return JsonResponse
     */
    public function store(UserStoreRequest $reqest)
    {
        $user=new User();
        $user->name=$reqest->name;
        $user->email=$reqest->email;
        $user->password=bcrypt($reqest->password);
        $user->access_level=$reqest->type;
        $user->api_token=Str::random(120);
        $user->save();
        return response()->json([
            'data'=>new UserResource($user),
            'status'=>'success'
        ],201);
    }

    /**
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'data'=>'done!',
            'status'=>'delete success user'
        ],204);
    }

    /**
     * @param UserStoreRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function update(UserStoreRequest $request,User $user)
    {
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->access_level=$request->type;
        $user->api_token=Str::random(120);
        $user->save();
        return response()->json([
            'data'=>new UserResource($user),
            'status'=>'success'
        ],204);
    }

    /**
     * @param User $user
     * @return JsonResponse
     */
    public function show(User $user)
    {
        return response()->json([
            'data'=>new UserResource($user),
            'status'=>'success'
        ],200);
    }

    /**
     * @param ChangeUserRequest $request
     * @return JsonResponse
     */
    public function changePassword(ChangeUserRequest $request)
    {
       $user=User::findOrFail(auth()->user()->id);
       $user->password=bcrypt($request->password);
       $user->save();
       $this->refreshToken();
        return response()->json([
            'data'=>new UserResource($user),
            'status'=>'success'
        ],200);
    }

    /**
     * @return JsonResponse
     */
    public function refreshToken()
    {
        return $this->respondWithToken(Auth::guard('api')->refresh());
    }

}
