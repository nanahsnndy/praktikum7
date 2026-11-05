@extends('posts.layouts.app')

@section('content')

<h2 class="text-2xl font-bold mb-6">
    Admin Dashboard
</h2>

{{-- STATISTIK --}}
<div class="grid grid-cols-2 md:grid-cols-3 gap-4">

    <x-stat-card
        label="Total Projects"
        :value="$totalProjects"
    />

    <x-stat-card
        label="Published"
        :value="$totalPublished"
        color="text-green-600"
    />

    <x-stat-card
        label="Draft"
        :value="$totalDraft"
        color="text-orange-600"
    />

    <x-stat-card
        label="Categories"
        :value="$totalCategories"
        color="text-green-600"
    />

    <x-stat-card
        label="Technologies"
        :value="$totalTechnologies"
        color="text-purple-600"
    />

    <x-stat-card
        label="Skills"
        :value="$totalSkills"
        color="text-orange-600"
    />

</div>


{{-- PROJECT PER CATEGORY --}}
<div class="bg-white rounded-lg shadow-md p-6 mt-8">

    <h3 class="text-lg font-bold mb-4">
        Projects per Category
    </h3>

    <div class="overflow-x-auto">

        <table class="w-full text-left">

            <thead>
                <tr class="border-b">
                    <th class="py-3">Category</th>
                    <th class="py-3">Total Projects</th>
                </tr>
            </thead>

            <tbody>

                @forelse ($categories as $category)

                    <tr class="border-b">
                        <td class="py-3">
                            {{ $category->name }}
                        </td>

                        <td class="py-3">
                            {{ $category->projects_count }}
                        </td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="2" class="py-3 text-gray-500">
                            Belum ada kategori.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>


{{-- TOP SKILLS --}}
<div class="bg-white rounded-lg shadow-md p-6 mt-8">

    <h3 class="text-lg font-bold mb-4">
        Top Skills
    </h3>

    <div class="space-y-3">

        @forelse ($topSkills as $skill)

            <div class="flex justify-between items-center border-b pb-3">

                <span class="font-medium">
                    {{ $skill->name }}
                </span>

                <span class="text-gray-600">
                    {{ $skill->projects_count }} Projects
                </span>

            </div>

        @empty

            <p class="text-gray-500">
                Belum ada skill.
            </p>

        @endforelse

    </div>

</div>


{{-- LATEST PROJECTS --}}
<div class="bg-white rounded-lg shadow-md p-6 mt-8">

    <h3 class="text-lg font-bold mb-4">
        Latest Projects
    </h3>

    <div class="space-y-3">

        @forelse ($latestProjects as $project)

            <div class="flex justify-between items-center border-b pb-3">

                <div>
                    <p class="font-medium">
                        {{ $project->title }}
                    </p>

                    <p class="text-sm text-gray-500">
                        {{ $project->category->name ?? 'No Category' }}
                    </p>
                </div>

                <span class="text-sm">
                    {{ ucfirst($project->status) }}
                </span>

            </div>

        @empty

            <p class="text-gray-500">
                Belum ada project.
            </p>

        @endforelse

    </div>

</div>

@endsection