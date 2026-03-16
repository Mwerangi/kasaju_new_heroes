<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageService
{
    protected $manager;

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver());
    }

    /**
     * Upload and optimize an image
     * 
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $directory
     * @param array $options
     * @return array ['path' => string, 'thumbnail' => string|null]
     */
    public function uploadAndOptimize($file, $directory = 'images', $options = [])
    {
        $defaults = [
            'max_width' => 1920,
            'max_height' => 1920,
            'quality' => 80,
            'thumbnail' => true,
            'thumbnail_width' => 300,
            'thumbnail_height' => 300,
        ];

        $options = array_merge($defaults, $options);

        // Generate unique filename
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $path = $directory . '/' . $filename;

        // Read and optimize the image
        $image = $this->manager->read($file->getRealPath());

        // Resize if larger than max dimensions
        if ($image->width() > $options['max_width'] || $image->height() > $options['max_height']) {
            $image->scale(
                width: $options['max_width'],
                height: $options['max_height']
            );
        }

        // Save optimized image
        $encoded = $image->toJpeg(quality: $options['quality']);
        Storage::disk('public')->put($path, $encoded);

        $result = ['path' => $path];

        // Generate thumbnail if requested
        if ($options['thumbnail']) {
            $thumbnailPath = $this->generateThumbnail(
                $image,
                $directory,
                $filename,
                $options['thumbnail_width'],
                $options['thumbnail_height']
            );
            $result['thumbnail'] = $thumbnailPath;
        }

        return $result;
    }

    /**
     * Generate a thumbnail from an image
     * 
     * @param \Intervention\Image\Interfaces\ImageInterface $image
     * @param string $directory
     * @param string $filename
     * @param int $width
     * @param int $height
     * @return string
     */
    protected function generateThumbnail($image, $directory, $filename, $width = 300, $height = 300)
    {
        $thumbnailFilename = 'thumb_' . $filename;
        $thumbnailPath = $directory . '/thumbnails/' . $thumbnailFilename;

        // Clone the image and resize
        $thumbnail = clone $image;
        $thumbnail->cover($width, $height);

        // Save thumbnail
        $encoded = $thumbnail->toJpeg(quality: 80);
        Storage::disk('public')->put($thumbnailPath, $encoded);

        return $thumbnailPath;
    }

    /**
     * Delete an image and its thumbnail
     * 
     * @param string $path
     * @param string|null $thumbnailPath
     * @return void
     */
    public function deleteImage($path, $thumbnailPath = null)
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }

        if ($thumbnailPath && Storage::disk('public')->exists($thumbnailPath)) {
            Storage::disk('public')->delete($thumbnailPath);
        }
    }

    /**
     * Optimize an existing image
     * 
     * @param string $path
     * @param array $options
     * @return bool
     */
    public function optimizeExisting($path, $options = [])
    {
        $defaults = [
            'max_width' => 1920,
            'max_height' => 1920,
            'quality' => 80,
        ];

        $options = array_merge($defaults, $options);

        if (!Storage::disk('public')->exists($path)) {
            return false;
        }

        $fullPath = Storage::disk('public')->path($path);
        $image = $this->manager->read($fullPath);

        // Resize if larger than max dimensions
        if ($image->width() > $options['max_width'] || $image->height() > $options['max_height']) {
            $image->scale(
                width: $options['max_width'],
                height: $options['max_height']
            );
        }

        // Save optimized image
        $encoded = $image->toJpeg(quality: $options['quality']);
        Storage::disk('public')->put($path, $encoded);

        return true;
    }
}
