<?php

namespace App\Http\Controllers;

use App\Models\Project\Project;
use Illuminate\Http\Request;
use Validator;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Suponiendo que recibes el ID del usuario como un parámetro de consulta
        $userId = request()->query('user_id');

        // Filtra los proyectos por el ID del usuario
        $projectsQuery = Project::where('user_id', $userId);

        $columns = request()->query('columns');
        if ($columns) {
            // Decode the JSON string to an array
            $columns = json_decode($columns, true);

            // Retrieve only the specified columns
            $projects = $projectsQuery->get($columns)->map(function ($project) use ($columns) {
                $filteredProject = collect();

                foreach ($columns as $column) {
                    $filteredProject[$column] = $project->{$column};
                }

                return $filteredProject;
            });
        } else {
            // If no columns specified, retrieve all columns
            $projects = $projectsQuery->get();
        }

        return response()->json($projects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'user_id' => 'required',
        ];

        $messages = [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de caracteres.',
            'name.max' => 'El nombre no puede tener más de 255 caracteres.',
            'description.required' => 'La descripción es obligatoria.',
            'description.string' => 'La descripción debe ser una cadena de caracteres.',
            'description.max' => 'La descripción no puede tener más de 255 caracteres.',
            'start_date.required' => 'La fecha de inicio es obligatoria.',
            'start_date.date' => 'La fecha de inicio debe ser una fecha válida.',
            'end_date.required' => 'La fecha de fin es obligatoria.',
            'end_date.date' => 'La fecha de fin debe ser una fecha válida.',
            'end_date.after_or_equal' => 'La fecha de fin debe ser igual o posterior a la fecha de inicio.',

        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $project = Project::query()->create($request->all());

        return response()->json($project, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $columns = request()->has('columns') ? json_decode(request('columns')) : ['id'];

        return response()->json(
            $project->only($columns),
            200
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $project->update($request->all());

        return response()->json($project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        return response()->json($project->delete(), 204);
    }
}
