<?php

namespace App\Service;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\Cache\ItemInterface;

class IpAddressService
{
    private $cache;
    private $http;

    public function __construct(){
        $this->cache = new FilesystemAdapter;
        $this->http = HttpClient::create();
    }

    public function getIp(): string
    {
        return $this->cache->get('cached_ip', function (ItemInterface $item) {
            return $this->http->request('GET', 'https://ip.seeip.org')->getContent();
        });
    }

    public function clearCachedIp()
    {
        $this->cache->deleteItem('cached_ip');
    }
}