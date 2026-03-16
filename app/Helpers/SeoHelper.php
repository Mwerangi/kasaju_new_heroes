<?php

namespace App\Helpers;

use App\Models\SeoSetting;
use Illuminate\Support\Facades\Cache;

class SeoHelper
{
    /**
     * Get SEO settings for a specific page
     *
     * @param string $page
     * @return object|null
     */
    public static function getPageSeo(string $page)
    {
        return Cache::remember("seo_settings_{$page}", 3600, function () use ($page) {
            return SeoSetting::where('page', $page)->first();
        });
    }

    /**
     * Get meta title for a page
     *
     * @param string $page
     * @param string|null $default
     * @return string
     */
    public static function getMetaTitle(string $page, ?string $default = null): string
    {
        $seo = self::getPageSeo($page);
        return $seo->meta_title ?? $default ?? config('app.name');
    }

    /**
     * Get meta description for a page
     *
     * @param string $page
     * @param string|null $default
     * @return string
     */
    public static function getMetaDescription(string $page, ?string $default = null): string
    {
        $seo = self::getPageSeo($page);
        return $seo->meta_description ?? $default ?? '';
    }

    /**
     * Get meta keywords for a page
     *
     * @param string $page
     * @param string|null $default
     * @return string
     */
    public static function getMetaKeywords(string $page, ?string $default = null): string
    {
        $seo = self::getPageSeo($page);
        return $seo->meta_keywords ?? $default ?? '';
    }

    /**
     * Get Open Graph title
     *
     * @param string $page
     * @param string|null $default
     * @return string
     */
    public static function getOgTitle(string $page, ?string $default = null): string
    {
        $seo = self::getPageSeo($page);
        return $seo->og_title ?? self::getMetaTitle($page, $default);
    }

    /**
     * Get Open Graph description
     *
     * @param string $page
     * @param string|null $default
     * @return string
     */
    public static function getOgDescription(string $page, ?string $default = null): string
    {
        $seo = self::getPageSeo($page);
        return $seo->og_description ?? self::getMetaDescription($page, $default);
    }

    /**
     * Get Open Graph image
     *
     * @param string $page
     * @param string|null $default
     * @return string|null
     */
    public static function getOgImage(string $page, ?string $default = null): ?string
    {
        $seo = self::getPageSeo($page);
        
        if ($seo && $seo->og_image) {
            return asset('storage/' . $seo->og_image);
        }
        
        return $default;
    }

    /**
     * Get canonical URL
     *
     * @param string $page
     * @return string
     */
    public static function getCanonicalUrl(string $page): string
    {
        $seo = self::getPageSeo($page);
        return $seo->canonical_url ?? url()->current();
    }
}
