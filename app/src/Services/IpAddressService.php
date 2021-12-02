<?php

namespace App\Services;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Contracts\Cache\ItemInterface;

class IpAddressService extends CacheService
{
    protected $cache;
    
    function __construct()
    {
        $this->cache = new FilesystemAdapter();
    }

    function getIp() : string
    {
        return $this->cache->get('cached_ip', function (ItemInterface $item) {
            return (new ApiRequest)->get('https://ip.seeip.org')->getContent();
        });
        
    }
}