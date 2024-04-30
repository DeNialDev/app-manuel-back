<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $columns = request()->query('columns');
        $projects = Project::all();
        if ($columns) {
            $projects = $projects->map(function ($loan) use ($columns) {
                $filteredBook = collect();

                foreach ($columns as $column) {
                    $filteredBook[$column] = $loan->{$column};
                }

                return $filteredBook;
            });
        }

        return response()->json($projects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $project = Project::query()->create($request->all());

        return response()->json($project, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return response()->json($project);
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
