<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Resources\Client\Task\TaskResource;
use App\Models\Task\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Task::query();

        return Response::json(TaskResource::collection($query->get()), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id = null): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'priority' => 'required|in:low,medium,high',
            'solved' => 'boolean',
            'solve_at' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return Response::json(['errors' => $validator->errors()], 422);
        }

        $task = new Task();
        if ($id) {
            $task = Task::find($id);
            if (!$task) {
                return Response::json(['error' => 'Task not found'], 404);
            }
        }

        DB::beginTransaction();
        try {
            $task->fill($request->all());
            $task->save();

            DB::commit();
        } catch (\Throwable|\Exception $e) {
            DB::rollBack();
            Log::error('Error while saving task due to: ' . $e->getMessage());
            return Response::json(['error' => 'An error occurred while processing your request'], 500);
        }

        return Response::json(TaskResource::make($task), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        if (!$id) {
            return Response::json(['error' => 'Task ID is required'], 400);
        }

        $task = Task::find($id);
        if (!$task) {
            return Response::json(['error' => 'Task not found'], 404);
        }

        return Response::json(TaskResource::make($task), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        if (!$id) {
            return Response::json(['error' => 'Task ID is required'], 400);
        }

        $task = Task::find($id);
        if (!$task) {
            return Response::json(['error' => 'Task not found'], 404);
        }

        $task->delete();

        return Response::json(['message' => 'Task deleted successfully'], 200);
    }
}
