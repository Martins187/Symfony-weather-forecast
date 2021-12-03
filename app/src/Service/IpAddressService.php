<?php

namespace App\Service;

use Symfony\Component\HttpClient\Response\CurlResponse;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\Cache\ItemInterface;

class IpAddressService
{
    public function __construct(
        private FilesystemAdapter $cache,
        private HttpClient $http
    ){}

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