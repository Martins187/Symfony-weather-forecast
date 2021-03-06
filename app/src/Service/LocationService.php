<?php

namespace App\Service;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\Cache\ItemInterface;

class LocationService
{
    private $cache;
    private $http;

    public function __construct(){
        $this->cache = new FilesystemAdapter;
        $this->http = HttpClient::create();
    }

    public function getLocationData(string $ip): array
    {
        return $this->http->request(
            'GET', 
            'http://api.ipstack.com/' . $ip .
            '?access_key=' . $_ENV['IPSTACK_KEY']
        )->toArray();
    }

    public function getCityName(string $ip): string
    {
        return $this->cache->get('cached_city_name', function (ItemInterface $item) use ($ip){
            $response = $this->getLocationData($ip);
            return $response['city'];
        });
    }

    public function clearCachedCityName(): Response
    {
        $this->cache->deleteItem('cached_city_name');
        return new Response();
    }
}