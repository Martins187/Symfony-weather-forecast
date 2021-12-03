<?php

namespace App\WeatherForecastProviders;

use Symfony\Component\HttpClient\HttpClient;
use App\WeatherForecastProviders\WeatherProviderInterface;

class OpenWeatherMapProvider implements WeatherProviderInterface
{
    function __construct(
        private HttpClient $http
    ){}

    function getForecast(string $city): string
    {
        return $this->http->request(
            'GET', 'https://api.openweathermap.org/data/2.5/weather?q='.
            $city.'&exclude=minutely,hourly,daily,alerts&appid='.$_ENV['OPENWEATHERMAP_KEY']
        )->getContent();
    }
}