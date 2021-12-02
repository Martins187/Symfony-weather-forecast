<?php

namespace App\Services;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpClient\Response\CurlResponse;

class ApiRequest 
{
    function __construct()
    {
        $this->client = HttpClient::create();
    }

    function get(string $url) : CurlResponse
    {
       return $this->client->request('GET', $url);
    }
}