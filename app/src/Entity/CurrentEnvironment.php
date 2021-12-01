<?php

namespace App\Entity;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\Cache\ItemInterface;

class CurrentEnvironment
{
    protected $ipAddress;
    protected $latitude;
    protected $longitude;
    protected $client;
    public $cache;

    function __construct()
    {
        $this->cache = new FilesystemAdapter();
        $this->client = HttpClient::create();
        $this->ipAddress = $this->getIp();
        $this->latitude = $this->getLocationData('latitude');
        $this->longitude = $this->getLocationData('longitude');

    }

    function getLocationData($parameter) : string
    {
        return $this->cache->get('cached_'.$parameter, function (ItemInterface $item) use ($parameter){
            $locationDataJson = $this->client->request('GET', 'http://api.ipstack.com/'.$this->ipAddress.'?access_key=4ad0e02fbf2e1a55a886b65c9d4a7644');
            $locationData = $locationDataJson->toArray();
            return $locationData[$parameter];
        });
       
    }

    function getIp() : string
    {
        return $this->cache->get('cached_ip', function (ItemInterface $item) {
            $response = $this->client->request('GET', 'https://ip.seeip.org');
            return $response->getContent();
        });
    }
}