<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Resources\ProjectResource;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::with(['category', 'technologies'])
            ->where('status', 'published')

            ->when($request->search, function ($query, $search) {
                $query->where('title', 'like', '%' . $search . '%');
            })

            ->when($request->category, function ($query, $category) {
                $query->whereHas('category', function ($q) use ($category) {
                    $q->where('slug', $category);
                });
            })

            ->latest()
            ->paginate(9);

        return ProjectResource::collection($projects);
    }

    public function show(Project $project)
    {
        return new ProjectResource(
            $project->load(['category', 'technologies'])
        );
    }
}