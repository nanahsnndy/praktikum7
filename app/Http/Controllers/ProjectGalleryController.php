<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Support\Facades\Storage;

class ProjectGalleryController extends Controller
{
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'images' => 'required|array|max:10',
            'images.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $currentCount = $project->images()->count();
        $newCount = count($request->file('images'));

        if ($currentCount + $newCount > 10) {
            return back()->withErrors([
                'images' => 'Maksimal 10 gambar untuk setiap project.'
            ]);
        }

        foreach ($request->file('images') as $image) {
            $path = $image->store('projects/gallery', 'public');

            $project->images()->create([
                'image' => $path,
            ]);
        }

        return back()->with('success', 'Gambar gallery berhasil ditambahkan.');
    }

    public function update(Request $request, Project $project, ProjectImage $image)
    {
        abort_if($image->project_id !== $project->id, 404);

        $request->validate([
            'caption' => 'nullable|string|max:255',
        ]);

        $image->update([
            'caption' => $request->caption,
        ]);

        return back()->with('success', 'Caption berhasil diperbarui.');
    }

    public function destroy(Project $project, ProjectImage $image)
    {
        abort_if($image->project_id !== $project->id, 404);

        Storage::disk('public')->delete($image->image);

        $image->delete();

        return back()->with('success', 'Gambar dihapus.');
    }
}