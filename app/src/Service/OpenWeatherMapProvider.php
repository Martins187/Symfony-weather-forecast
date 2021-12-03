<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;

class OpenWeatherMapProvider implements WeatherProviderInterface
{
    public function __construct(private HttpClient $http){}

    public function getForecast(string $city): string
    {
        return $this->http->request(
            'GET', 
            'https://api.openweathermap.org/data/2.5/weather?q='. $city .
            '&exclude=minutely,hourly,daily,alerts&appid='.$_ENV['OPENWEATHERMAP_KEY']
        )->getContent();
    }
}