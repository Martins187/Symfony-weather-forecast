<?php

namespace App\Service;

use Symfony\Component\HttpClient\Response\CurlResponse;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\Cache\ItemInterface;

class IpAddressService
{
    protected $cache;
    protected $client;

    function __construct()
    {
        $this->cache = new FilesystemAdapter();
        $this->client = HttpClient::create();
    }

    function getIp(): string
    {
        return $this->cache->get('cached_ip', function (ItemInterface $item) {
            return $this->client->request('GET', 'https://ip.seeip.org')->getContent();
        });
    }

    function clearCachedIp()
    {
        $this->cache->deleteItem('cached_ip');
    }
}