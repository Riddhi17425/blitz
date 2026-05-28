<?php

use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Drivers\Imagick\Driver as ImagickDriver;
use Ilovepdf\Ilovepdf;

if (! function_exists('storeImage')) {
    function storeImage($file, $folder, $quality = 60, $maxWidth = 1200, $maxHeight = 1200)
    {
        if (!$file) {
            return null; 
        }

        try {
            $directoryPath = public_path($folder);

            // Create directory if it doesn't exist
            if (!file_exists($directoryPath)) {
                mkdir($directoryPath, 0755, true);
            }

            // Get original filename and extension
            $originalName = $file->getClientOriginalName();
            $pathInfo = pathinfo($originalName);
            $nameWithoutExt = $pathInfo['filename'];
            $originalExt = strtolower($pathInfo['extension'] ?? '');

            // Normalize extensions
            if ($originalExt === 'jfif') {
                $originalExt = 'jpg';
            }

            if ($file->getMimeType() === 'image/webp') {
                $originalExt = 'webp';
            }

            // ------------------------------
            // Handle SVG → Store as-is
            // ------------------------------
            if ($originalExt === 'svg' || $file->getMimeType() === 'image/svg+xml') {
                $filename = $originalName;
                $counter = 1;
                while (file_exists($directoryPath . '/' . $filename)) {
                    $filename = $nameWithoutExt . '_' . $counter . '.svg';
                    $counter++;
                }

                $file->move($directoryPath, $filename);

                Log::info('SVG stored without modification', [
                    'original_name' => $originalName,
                    'final_name' => $filename,
                ]);

                return $filename;
            }

            // ------------------------------
            // Handle WebP → Store as-is
            // ------------------------------
            if ($originalExt === 'webp') {
                $originalSize = $file->getSize(); // get size BEFORE moving

                $filename = $originalName;
                $counter = 1;
                while (file_exists($directoryPath . '/' . $filename)) {
                    $filename = $nameWithoutExt . '_' . $counter . '.webp';
                    $counter++;
                }

                $file->move($directoryPath, $filename);

                Log::info('WebP stored without compression', [
                    'original_name'   => $originalName,
                    'final_name'      => $filename,
                    'original_size'   => number_format($originalSize / 1024 / 1024, 2) . ' MB',
                    'dimensions'      => 'kept original',
                ]);

                return $filename;
            }

            // ------------------------------
            // Non-WebP & Non-SVG processing
            // ------------------------------

            $filename = $originalName;
            $counter = 1;
            while (file_exists($directoryPath . '/' . $filename)) {
                $filename = $nameWithoutExt . '_' . $counter . '.' . $originalExt;
                $counter++;
            }

            $filePath = $directoryPath . '/' . $filename;

            // Create ImageManager instance
            $manager = extension_loaded('imagick') 
                ? new ImageManager(new ImagickDriver()) 
                : new ImageManager(new Driver());

            // Read the image
            $image = $manager->read($file->getRealPath());

            // Resize if larger than max dimensions
            if ($image->width() > $maxWidth || $image->height() > $maxHeight) {
                $image->scale(width: $maxWidth, height: $maxHeight);
            }

            // Save based on format
            switch ($originalExt) {
                case 'jpg':
                case 'jpeg':
                    $image->toJpeg($quality)->save($filePath);
                    break;

                case 'png':
                    if ($quality < 70) {
                        $newFilename = $nameWithoutExt . '.jpg';
                        $counter = 1;
                        while (file_exists($directoryPath . '/' . $newFilename)) {
                            $newFilename = $nameWithoutExt . '_' . $counter . '.jpg';
                            $counter++;
                        }
                        $filePath = $directoryPath . '/' . $newFilename;
                        $image->toJpeg($quality)->save($filePath);
                        $filename = $newFilename;
                    } else {
                        $image->toPng()->save($filePath);
                    }
                    break;

                default:
                    $newFilename = $nameWithoutExt . '.jpg';
                    $counter = 1;
                    while (file_exists($directoryPath . '/' . $newFilename)) {
                        $newFilename = $nameWithoutExt . '_' . $counter . '.jpg';
                        $counter++;
                    }
                    $filePath = $directoryPath . '/' . $newFilename;
                    $image->toJpeg($quality)->save($filePath);
                    $filename = $newFilename;
            }

            return $filename;

        } catch (\Exception $e) {
            Log::error('Image storage failed: ' . $e->getMessage());
            return null;
        }
    }
    
}
