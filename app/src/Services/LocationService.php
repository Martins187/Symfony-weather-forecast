<?php

namespace App\Services;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Contracts\Cache\ItemInterface;

class LocationService
{
    protected $cache;

    function __construct()
    {
        $this->cache = new FilesystemAdapter();
    }

    function getLocationData(string $ip) : array
    {
        return (new ApiRequest)->get('http://api.ipstack.com/'.$ip.'?access_key='.$_ENV['IPSTACK_KEY']);
    }

    function getCityName(string $ip) : string
    {
        return $this->cache->get('cached_city_name', function (ItemInterface $item) use ($ip){
            $response = $this->getLocationData($ip)->toArray();
            return $response['city'];
        });
    }
}