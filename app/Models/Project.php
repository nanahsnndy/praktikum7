<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'short_description',
        'description',
        'status',
        'project_date',
        'is_featured',
        'project_url',
        'repository_url',
        'thumbnail',
    ];

    protected static function booted()
    {
        static::creating(function ($project) {
            if (empty($project->slug)) {
                $slug = Str::slug($project->title);
                $originalSlug = $slug;
                $counter = 1;

                while (
                    static::where('slug', $slug)->exists()
                ) {
                    $counter++;
                    $slug = $originalSlug . '-' . $counter;
                }

                $project->slug = $slug;
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProjectImage::class)
            ->orderBy('sort_order');
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class)
            ->withTimestamps();
    }

    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }
}