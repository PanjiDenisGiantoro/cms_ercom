<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Format;
use Intervention\Image\ImageManager;

class ImageOptimizer
{
    private const MAX_WIDTH = 1920;

    private const QUALITY = 80;

    /**
     * Store an uploaded file, transparently resizing (down only, never
     * upscaled) and re-encoding it as WebP when it's a compressible image.
     * Non-image files (video, etc.) and formats we don't want to touch
     * (SVG, animated GIF) are stored as-is.
     */
    public static function store(UploadedFile $file, string $directory, string $disk = 'public'): string
    {
        if (! self::isCompressible($file)) {
            return $file->storeAs($directory, self::randomFilename($file), $disk);
        }

        $manager = ImageManager::usingDriver(Driver::class);
        $image = $manager->decodePath($file->getRealPath());
        $image->scaleDown(width: self::MAX_WIDTH);

        $encoded = $image->encodeUsingFormat(Format::WEBP, quality: self::QUALITY);
        $filename = ((string) Str::uuid()).'.webp';

        Storage::disk($disk)->put($directory.'/'.$filename, (string) $encoded);

        return $directory.'/'.$filename;
    }

    private static function isCompressible(UploadedFile $file): bool
    {
        $mime = $file->getMimeType();

        return $mime
            && str_starts_with($mime, 'image/')
            && ! in_array($mime, ['image/svg+xml', 'image/gif'], true);
    }

    private static function randomFilename(UploadedFile $file): string
    {
        $extension = $file->getClientOriginalExtension() ?: $file->extension();

        return ((string) Str::uuid()).($extension ? '.'.$extension : '');
    }
}
