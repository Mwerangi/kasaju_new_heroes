<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id',
        'section_key',
        'title',
        'subtitle',
        'content',
        'image',
        'button_text',
        'button_link',
        'additional_data',
        'order',
        'is_active',
    ];

    protected $casts = [
        'additional_data' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Get the page that owns the section.
     */
    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
