<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiaryPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'slug',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function isPublished(): bool
    {
        return $this->published_at !== null;
    }

    public function publish(): bool
    {
        return $this->update([
            'published_at' => $this->freshTimestamp(),
        ]);
    }

    public function unpublish(): bool
    {
        return $this->update([
            'published_at' => null,
        ]);
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('published_at', 'desc');
    }

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at');
    }

    public function scopeDraft($query)
    {
        return $query->whereNull('published_at');
    }
}
