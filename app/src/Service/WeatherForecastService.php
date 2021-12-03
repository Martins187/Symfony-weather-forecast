<?php

namespace App\Service;

use App\WeatherForecastProviders\WeatherProviderInterface;
use Symfony\Component\HttpClient\HttpClient;

class WeatherForecastService
{
    function getForecast(WeatherProviderInterface $weatherProvider, string $city): string
    {
        return $weatherProvider->getForecast($city);
    }
}