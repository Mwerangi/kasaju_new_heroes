<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'page',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
        'og_image',
        'canonical_url',
        'structured_data',
    ];

    protected $casts = [
        'structured_data' => 'array',
    ];

    /**
     * Get SEO settings for a specific page.
     */
    public static function getForPage($page)
    {
        return self::where('page', $page)->first();
    }

    /**
     * Update or create SEO settings for a page.
     */
    public static function updateForPage($page, array $data)
    {
        return self::updateOrCreate(
            ['page' => $page],
            $data
        );
    }
}
