<?php

namespace App\Http\Controllers;

use App\Models\Project;

class PublicProjectController extends Controller
{
    public function show(string $slug)
    {
        $project = Project::with(['category', 'images', 'skills'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        return view('projects.show', compact('project'));
    }
}