<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TodoController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Todo::get();

        return $this->sendResponse($data, 'todo list retrieved successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TodoRequest $request)
    {
        $input = $request->all();
        $data = Todo::create($input);

        return $this->sendResponse($data, 'todo list created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $data = Todo::findOrFail($id);

            return $this->sendResponse($data, 'todo list retrieved successfully');
        } catch (ModelNotFoundException $e) {
            return $this->sendError('Todo not found', $e->getMessage(), 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TodoRequest $request, string $id)
    {
        try {
            $data = Todo::findOrFail($id);

            $input = $request->all();
            $data->update($input);

            return $this->sendResponse($data, 'todo list updated successfully');
        } catch (ModelNotFoundException $e) {
            return $this->sendError('Todo update failed', $e->getMessage(), 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = Todo::findOrFail($id);
            $data = Todo::find($id);
            $data->delete();

            return $this->sendResponse($data, 'todo list deleted successfully');
        } catch (ModelNotFoundException $e) {
            return $this->sendError('Todo delete failed', $e->getMessage(), 404);
        }
    }
}
