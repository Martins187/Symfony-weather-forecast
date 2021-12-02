<?php

namespace App\Services;

class WeatherForecastService
{
    function getForecast(string $city) :string
    {
        return (new ApiRequest)->get('https://api.openweathermap.org/data/2.5/weather?q='.$city.'&exclude=minutely,hourly,daily,alerts&appid='.$_ENV['OPENWEATHERMAP_KEY'])->getContent();
    }
}