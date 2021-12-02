<?php

namespace App\Services;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;

abstract class CacheService
{
    protected $cache;

    function __construct()
    {
        $this->cache = new FilesystemAdapter();
    }

}