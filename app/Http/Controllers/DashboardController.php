<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Technology;

class DashboardController extends Controller
{
    public function index()
    {
        return view('posts.dashboard.index', [
            'totalProjects' => Project::count(),

            'totalPublished' => Project::where('status', 'published')->count(),

            'totalDraft' => Project::where('status', 'draft')->count(),

            'totalCategories' => Category::count(),

            'totalTechnologies' => Technology::count(),

            'totalSkills' => Skill::count(),

            'latestProjects' => Project::with('category')
                ->latest()
                ->take(5)
                ->get(),

            'categories' => Category::withCount('projects')
                ->orderByDesc('projects_count')
                ->get(),

            'topSkills' => Skill::withCount('projects')
                ->orderByDesc('projects_count')
                ->take(5)
                ->get(),
        ]);
    }
}