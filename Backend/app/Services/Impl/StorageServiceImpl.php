<?php

namespace App\Services\Impl;

use App\Services\StorageService;
use Illuminate\Support\Facades\File;

class StorageServiceImpl implements StorageService
{
    public function getObject($key)
    {
        $imagePath = storage_path($key);
        if (File::exists($imagePath)) {
            return $imagePath;
        }
        return null;
    }

    public function putObject($key, $file)
    {
        if ($file->isValid()) {
            $path = $file->store($key,'public');
            return basename($path);
        }
        return null;
    }
}
