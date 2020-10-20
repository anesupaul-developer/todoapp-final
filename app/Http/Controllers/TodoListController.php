<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TodoListController extends Controller
{
    /** Only authenticated users can interact with the TodoListController */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $user_id = Auth::user()->id;
        $todos = TodoList::where('user_id', $user_id)->paginate(10);

        return response()->json([
            'status' => true,
            'message' => $todos
        ]);
    }

    /** Create a new todolist into the database */
    public function store(Request $request)
    {
        $validator = $this->validate_todolist_data($request);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        $todoList = new TodoList();
        $todoList->title = $request->input('title');
        $todoList->description = $request->input('description');
        $todoList->due_date = $request->input('due_date');
        $todoList->user_id = Auth::user()->id;
        $todoList->save();

        return response()->json([
            'status' => true,
            'message' => TodoList::all()
        ]);
    }

    public function completed(TodoList $todo)
    {
        $todo->update(['is_completed' => true]);
        return response()->json([
            'status' => true,
            'message' => $todo->fresh()
        ]);
    }

    public function update(TodoList $todo)
    {
        $todo->update($this->validateRequest());
        return response()->json([
            'status' => true,
            'message' => $todo->fresh()
        ]);
    }

    public function delete(TodoList $todo)
    {
        $todo->delete();
        return response()->json([
            'status' => true,
            'message' => TodoList::all()
        ]);
    }

    private function validate_todolist_data(Request $request)
    {
        return Validator::make($request->all(), $this->validationRules());
    }

    private function validateRequest()
    {
        return request()->validate($this->validationRules());
    }

    private function validationRules()
    {
        return [
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'required|date'
        ];
    }
}
