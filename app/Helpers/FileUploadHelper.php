<?php

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

if (!function_exists('sanitizeFileName')) {
  /**
   * Sanitize the file name to be URL-friendly.
   *
   * @param string $fileName
   * @return string
   */
  function sanitizeFileName($fileName)
  {
    return preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $fileName);
  }
}

if (!function_exists('imageUpload')) {
  function imageUpload($file, $directory = "directory", $allowedMimeTypes = ['image/jpeg', 'image/png'], $maxSize = 2048)
  {

    if (!$file->isValid()) {
      return ['status' => false, 'message' => 'Invalid file upload.'];
    }

    if ($file->getSize() / 1024 > $maxSize) {
      return ['status' => false, 'message' => 'File exceeds the maximum size limit.'];
    }

    if (!in_array($file->getMimeType(), $allowedMimeTypes)) {
      return ['status' => false, 'message' => 'File type not allowed.'];
    }

    $fileName = uniqid() . '_' . sanitizeFileName($file->getClientOriginalName());


    try {
      if (!Storage::disk('public')->exists($directory)) {
        $filePath = Storage::disk('public')->putFileAs($directory, $file, $fileName);
      }
      $filePath = Storage::disk('public')->putFileAs($directory, $file, $fileName);

      return ['status' => true, 'file_path' => $filePath];
    } catch (\Exception $e) {
      Log::error('File upload error: ' . $e->getMessage());
      return ['status' => false, 'message' => "File upload failed, Error: " . $e->getMessage()];
    }
  }
}
