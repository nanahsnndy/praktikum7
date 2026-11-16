<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Category;
use App\Models\Technology;

class PublicProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::with(['category', 'technologies'])
            ->where('status', 'published')

            ->when($request->filled('search'), function ($q) use ($request) {
                $search = $request->search;

                $q->where(function ($w) use ($search) {
                    $w->where('title', 'like', "%{$search}%")
                        ->orWhere('short_description', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })

            ->when($request->filled('category'), function ($q) use ($request) {
                $q->whereHas('category', function ($w) use ($request) {
                    $w->where('slug', $request->category);
                });
            })

            ->when($request->filled('technology'), function ($q) use ($request) {
                $q->whereHas('technologies', function ($w) use ($request) {
                    $w->where('slug', $request->technology);
                });
            });

        switch ($request->query('sort')) {
            case 'terlama':
                $query->orderBy('project_date', 'asc');
                break;

            case 'az':
                $query->orderBy('title', 'asc');
                break;

            default:
                $query->orderBy('project_date', 'desc');
                break;
        }

        $projects = $query->paginate(9)->withQueryString();

        $categories = Category::orderBy('name')->get();
        $technologies = Technology::orderBy('name')->get();

        return view('projects', compact(
            'projects',
            'categories',
            'technologies'
        ));
    }

    public function show(string $slug)
    {
        $project = Project::with([
            'category',
            'images',
            'skills',
            'technologies'
        ])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        return view('projects.show', compact('project'));
    }
}
