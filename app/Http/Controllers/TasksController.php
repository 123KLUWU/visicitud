<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Tasks;
use App\Models\Frequencies;
use App\Models\Priorities;
use App\Models\Statuses;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

            $tasks = Tasks::all();

             if ($tasks->isEmpty()) {
                 return view('tasks.index', ['tasks' => []]);
             }
    
            return view('tasks.index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks/create', [
            'priorities' => Priorities::all(),
            'statuses' => Statuses::all(),
            'frequencies' => Frequencies::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'due_date' => 'nullable|date',
            'priority_id' => 'nullable|integer|exists:priorities,id',
            'status_id' => 'nullable|integer|exists:statuses,id',
            'recurrent' => 'nullable|boolean',
            'frequency_id' => 'nullable|integer|exists:frequencies,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'repetitions' => 'nullable|integer'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $tasks = Tasks::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'priority_id' => $request->priority_id,
            'status_id' => $request->status_id,
            'recurrent' => $request->recurrent,
            'frequency_id' => $request->frequency_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'repetitions' => $request->repetitions
        ]);
        return redirect()->route('tasks.create')->with('success', 'Tarea creada con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        
        $tasks = Tasks::find($id);

        if (!$tasks) {
            $data = [
                'message' => 'Tarea no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'task' => $tasks,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $tasks = Tasks::find($id);

        if (!$tasks) {
            $data = [
                'message' => 'Tarea no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            //'user_id' => 'required|integer|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'due_date' => 'nullable|date',
            'priority_id' => 'nullable|integer|exists:priorities,id',
            'status_id' => 'nullable|integer|exists:statuses,id',
            'recurrent' => 'nullable|boolean',
            'frequency_id' => 'nullable|integer|exists:frequencies,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'repetitions' => 'nullable|integer'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        /*
        if ($request->has('user_id')){
            $tasks->user_id = $request->user_id;
        }
        */
        if ($request->has('title')){
            $tasks->title = $request->title;
        }
        if ($request->has('description')){
            $tasks->description = $request->description;
        }
        if ($request->has('due_date')){
            $tasks->due_date = $request->due_date;
        }
        if ($request->has('priority_id')){
            $tasks->priority_id = $request->priority_id;
        }
        if ($request->has('status_id')){
            $tasks->status_id = $request->status_id;
        }
        if ($request->has('recurrent')){
            $tasks->recurrent = $request->recurrent;
        }
        if ($request->has('frequency_id')){
            $tasks->frequency_id = $request->frequency_id;
        }
        if ($request->has('start_date')){
            $tasks->start_date = $request->start_date;
        }
        if ($request->has('end_date')){
            $tasks->end_date = $request->end_date;
        }
        if ($request->has('repetitions')){
            $tasks->repetitions = $request->repetitions;
        }

        $tasks->save();

        $data = [
            'message' => 'Tarea actualizada',
            'task' => $tasks,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $tasks = Tasks::find($id);

        if (!$tasks) {
            $data = [
                'message' => 'tarea no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            //'user_id' => 'required|integer|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'due_date' => 'nullable|date',
            'priority_id' => 'nullable|integer|exists:priorities,id',
            'status_id' => 'nullable|integer|exists:statuses,id',
            'recurrent' => 'nullable|boolean',
            'frequency_id' => 'nullable|integer|exists:frequencies,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'repetitions' => 'nullable|integer'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        //$tasks->user_id = $request->user_id;
        $tasks->title = $request->title;
        $tasks->description = $request->description;
        $tasks->due_date = $request->due_date;
        $tasks->priority_id = $request->priority_id;
        $tasks->status_id = $request->status_id;
        $tasks->recurrent = $request->recurrent;
        $tasks->frequency_id = $request->frequency_id;
        $tasks->start_date = $request->start_date;
        $tasks->end_date = $request->end_date;
        $tasks->repetitions = $request->repetitions;

        $tasks->save();

        $data = [
            'message' => 'Tarea actualizada',
            'task' => $tasks,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tasks = Tasks::find($id);

        if ($tasks) {
            $tasks->delete();
            return redirect()->route('tasks.index')->with('success', 'Tarea eliminada exitosamente.');
        } else {
            return redirect()->route('tasks.index')->with('error', 'El producto no fue encontrado.');
        }
    }
}
