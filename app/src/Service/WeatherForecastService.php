<?php

namespace App\Service;

use App\WeatherForecastProviders\WeatherProviderInterface;
use Symfony\Component\HttpClient\HttpClient;

class WeatherForecastService
{
    protected $client;

    function __construct()
    {
        $this->client = HttpClient::create();
    }

    function getForecast(WeatherProviderInterface $weatherProvider, string $city): string
    {
        return $weatherProvider->getForecast($city);
    }
}