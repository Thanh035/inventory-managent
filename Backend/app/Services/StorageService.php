<?php

namespace App\Services;

interface StorageService
{

    public function getObject($key);

    public function putObject($key, $file);
}
