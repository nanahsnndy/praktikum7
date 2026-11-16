<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Technology extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];

    protected static function booted()
    {
        static::creating(function ($technology) {
            if (empty($technology->slug)) {
                $technology->slug = Str::slug($technology->name);
            }
        });
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
}
