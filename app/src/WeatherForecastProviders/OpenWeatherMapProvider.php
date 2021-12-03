<?php

namespace App\WeatherForecastProviders;

use Symfony\Component\HttpClient\HttpClient;
use App\WeatherForecastProviders\WeatherProviderInterface;

class OpenWeatherMapProvider implements WeatherProviderInterface
{
    protected $client;

    function __construct()
    {
        $this->client = HttpClient::create();
    }

    function getForecast(string $city): string
    {
        return $this->client->request('GET', 'https://api.openweathermap.org/data/2.5/weather?q='.$city.'&exclude=minutely,hourly,daily,alerts&appid='.$_ENV['OPENWEATHERMAP_KEY'])->getContent();
    }
}