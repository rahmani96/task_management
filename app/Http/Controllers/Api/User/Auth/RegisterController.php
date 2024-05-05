<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Utilities\ApiResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Register User
     * @param Request $request
     * @return User
     */
    public function registerUser(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(),[
                'name' => 'required|max:30',
                'email' => 'required|unique:App\Models\User,email',
                'password' => 'required',
            ]);
            if($validateUser->fails()){
                return ApiResponse::error('Validation error', $validateUser->errors(), 400);
            }
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $access_token = $user->createToken("API TOKEN")->plainTextToken;
            return ApiResponse::success('User Created Successfully', $user, 201, $access_token);
        } catch (\Throwable $th) {
            return ApiResponse::error("Registre user operation failed! Try again", $th->getMessage(), 500);
        }
    }
}
