<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Utilities\ApiResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Nette\Utils\Arrays;

class LoginController extends Controller
{
     /**
     * Login User
     * @param Request $request
     * @return User
     */
    public function loginUser(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(),[
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if($validateUser->fails()){
                return ApiResponse::error('Validation error', $validateUser->errors(), 400);
            }

            if(!Auth::guard('web')->attempt($request->only(['email', 'password']))){
                return ApiResponse::success('No user found with those credentials', null, 404);
            }

            $user = User::where('email', $request->email)->first();
            $access_token = $user->createToken("API TOKEN")->plainTextToken;
            $permissions = $user->getAllPermissions();
            return ApiResponse::success('User logged in successfully', ['user' => $user, 'permissions' => $permissions], 200, $access_token);
        } catch (\Throwable $th) {
            return ApiResponse::error($request, $th->getMessage(), 500);
        }
    }
}
