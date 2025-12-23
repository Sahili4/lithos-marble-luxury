<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Catalog extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'origin',
        'description',
        'image',
        'type',
        'application',
        'is_featured',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'status' => 'boolean',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Auto-generate slug from name
        static::creating(function ($catalog) {
            if (empty($catalog->slug)) {
                $catalog->slug = Str::slug($catalog->name);
            }
        });

        static::updating(function ($catalog) {
            if ($catalog->isDirty('name') && empty($catalog->slug)) {
                $catalog->slug = Str::slug($catalog->name);
            }
        });
    }

    /**
     * Get the image URL.
     */
    public function getImageUrlAttribute()
    {
        return $this->image ? asset($this->image) : asset('assets/images/placeholder.png');
    }

    /**
     * Scope for active catalogs.
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Scope for featured catalogs.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope for ordering by sort order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('created_at', 'desc');
    }
}
