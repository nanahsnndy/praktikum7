<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('category')->latest()->get();

        return view('posts.projects.index', compact('projects'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('posts.projects.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048|dimensions:min_width=400,min_height=300',
            'images' => 'nullable|array|max:10',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $thumbnail = null;

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail')->store('projects/thumbnails', 'public');
        }

        $project = Project::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'thumbnail' => $thumbnail,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('projects/gallery', 'public');

                $project->images()->create([
                    'image' => $path,
                ]);
            }
        }

        return redirect()->route('post.projects.create')
            ->with('success', 'Project berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $project = Project::with('images')->findOrFail($id);

        return view('posts.projects.show', compact('project'));
    }

    public function edit(string $id)
    {
        $project = Project::findOrFail($id);
        $categories = Category::all();
    
        return view('posts.projects.edit', compact('project', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $project = Project::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048|dimensions:min_width=400,min_height=300',
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($project->thumbnail) {
                Storage::disk('public')->delete($project->thumbnail);
            }

            $thumbnail = $request->file('thumbnail')->store('projects/thumbnails', 'public');

            $project->thumbnail = $thumbnail;
        }

        $project->category_id = $request->category_id;
        $project->title = $request->title;
        $project->description = $request->description;

        $project->save();

        return redirect()->route('post.projects.index')
            ->with('success', 'Project berhasil diperbarui.');
    }


    public function destroy(string $id)
    {
        $project = Project::with('images')->findOrFail($id);

        if ($project->thumbnail) {
            Storage::disk('public')->delete($project->thumbnail);
        }

        foreach ($project->images as $image) {
            Storage::disk('public')->delete($image->image);
            $image->delete();
        }

        $project->delete();

        return redirect()->route('post.projects.index')
            ->with('success', 'Project berhasil dihapus.');
    }
}
