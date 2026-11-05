<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('title');
        });

        $projects = DB::table('projects')->get();

        foreach ($projects as $project) {
            $slug = Str::slug($project->title);
            $originalSlug = $slug;
            $counter = 1;

            while (
                DB::table('projects')
                    ->where('slug', $slug)
                    ->exists()
            ) {
                $counter++;
                $slug = $originalSlug . '-' . $counter;
            }

            DB::table('projects')
                ->where('id', $project->id)
                ->update(['slug' => $slug]);
        }
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};