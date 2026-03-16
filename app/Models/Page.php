<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($page) {
            if (empty($page->slug)) {
                $page->slug = Str::slug($page->title);
            }
        });
    }

    /**
     * Get the sections for the page.
     */
    public function sections()
    {
        return $this->hasMany(PageSection::class)->orderBy('order');
    }

    /**
     * Get active sections for the page.
     */
    public function activeSections()
    {
        return $this->sections()->where('is_active', true);
    }

    /**
     * Get a specific section by key.
     */
    public function getSection($key)
    {
        return $this->sections()->where('section_key', $key)->first();
    }
}
