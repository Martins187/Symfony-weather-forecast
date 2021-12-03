<?php

namespace App\Service;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\Cache\ItemInterface;

class LocationService
{
    function __construct(
        private FilesystemAdapter $cache,
        private HttpClient $http
    ){}

    function getLocationData(string $ip): array
    {
       return $this->http->request('GET', 'http://api.ipstack.com/'
       .$ip.'?access_key='.$_ENV['IPSTACK_KEY'])->toArray();
    }

    function getCityName(string $ip): string
    {
        return $this->cache->get('cached_city_name', function (ItemInterface $item) use ($ip){
            $response = $this->getLocationData($ip);
            return $response['city'];
        });
    }

    function clearCachedCityName(): Response
    {
        $this->cache->deleteItem('cached_city_name');
        return new Response();
    }
}