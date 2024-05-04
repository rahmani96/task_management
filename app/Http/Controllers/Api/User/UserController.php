<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Utilities\ApiResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Utilities\ApiResponse
     */
    public function index()
    {
        try {
            return ApiResponse::success('Get Users Successfully', User::all(), 200);
        } catch (\Throwable $th) {
            return ApiResponse::error("Get all users operation failed", $th->getMessage(), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return App\Http\Utilities\ApiResponse
     */
    public function store(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(),[
                'name' => 'required|max:30',
                'email' => 'required|unique:App\Models\User,email',
                'password' => 'required|confirmed',
            ]);
            if($validateUser->fails()){
                return ApiResponse::error('Validation error', $validateUser->errors(), 400);
            }
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            return ApiResponse::success('User Created Successfully', $user, 201);
        } catch (\Throwable $th) {
            return ApiResponse::error("Registre user operation failed! Try again", $th->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return App\Http\Utilities\ApiResponse
     */
    public function show($id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return ApiResponse::error("Get specified user operation failed", 'The specified user does not exist', 404);
            }
            return ApiResponse::success('Get user successfully', $user, 200);
        } catch (\Throwable $th) {
            return ApiResponse::error("Get specified user operation failed", $th->getMessage(), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return App\Http\Utilities\ApiResponse
     */
    public function update(Request $request, User $user)
    {
        try {
            $validateUser = Validator::make($request->all(),[
                'name' => 'required|max:30',
                'email' => 'required|unique:App\Models\User,email'. $user->id,
                'password' => 'required|confirmed',
            ]);
            if($validateUser->fails()){
                return ApiResponse::error('Validation error', $validateUser->errors(), 400);
            }
            $user->update($request->all());
            return ApiResponse::success('User updated Successfully', $user, 200);
        } catch (\Throwable $th) {
            return ApiResponse::error("Update operation failed", $th->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return App\Http\Utilities\ApiResponse
     */
    public function destroy($id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return ApiResponse::error("Delete operation failed", 'The specified user does not exist', 404);
            }
            $user->delete();
            return ApiResponse::success('User deleted Successfully', null, 200);
        } catch (\Throwable $th) {
            return ApiResponse::error("Delete operation failed! Try again", $th->getMessage(), 500);
        }
    }
}
