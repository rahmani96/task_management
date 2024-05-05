<?php

namespace App\Http\Controllers\Api\Task;

use App\Events\SharedTask;
use App\Http\Controllers\Controller;
use App\Http\Utilities\ApiResponse;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Utilities\ApiResponse
     */
    public function index()
    {
        try {
            return ApiResponse::success('Get Tasks Successfully', Task::with('user')->get(), 200);
        } catch (\Throwable $th) {
            return ApiResponse::error("Get all Tasks operation failed", $th->getMessage(), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return App\Http\Utilities\ApiResponse
     */
    public function store(Request $request)
    {
        try {
            $validateTask = Validator::make($request->all(),[
                'title' => 'required|max:190',
                'description' => 'required|max:255',
                'complete' => 'boolean'
            ]);
            if($validateTask->fails()){
                return ApiResponse::error('Validation error', $validateTask->errors(), 400);
            }
            $task = Task::create([
                'title' => $request->title,
                'description' => $request->description,
                'complete' => $request->complete,
                'user_id' => Auth::user()->id
            ]);
            event(new SharedTask($task));
            return ApiResponse::success('Task Created Successfully', $task, 201);
        } catch (\Throwable $th) {
            return ApiResponse::error("Create operation failed", $th->getMessage(), 500);
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
            $task = Task::find($id);
            if (!$task) {
                return ApiResponse::error("Get specified task operation failed", 'The specified task does not exist', 404);
            }
            return ApiResponse::success('Get task details successfully', $task, 200);
        } catch (\Throwable $th) {
            return ApiResponse::error("Get specified task operation failed", $th->getMessage(), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return App\Http\Utilities\ApiResponse
     */
    public function update(Request $request, Task $task)
    {
        try {
            $validateTask = Validator::make($request->all(),[
                'title' => 'required|max:190',
                'description' => 'required|max:255',
                'complete' => 'boolean',
            ]);
            if($validateTask->fails()){
                return ApiResponse::error('Validation error', $validateTask->errors(), 400);
            }
            $task->update($request->all());
            return ApiResponse::success('Task updated Successfully', $task, 200);
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
            $task = Task::find($id);
            if (!$task) {
                return ApiResponse::error("Delete operation failed", 'The specified task does not exist', 404);
            }
            $task->delete();
            return ApiResponse::success('Task deleted Successfully', null, 200);
        } catch (\Throwable $th) {
            return ApiResponse::error("Delete operation failed", $th->getMessage(), 500);
        }
    }
}
