<?php

namespace App\Entity;

class WeatherForecast extends CurrentEnvironment
{
    function getData()
    {
        $weatherForecast = $this->client->request('GET', 'https://api.openweathermap.org/data/2.5/onecall?lat='.$this->latitude.'&lon='.$this->longitude.'&exclude=minutely,hourly,daily,alerts&appid=26e29aa16ee3a3a8af761f4dd0410824');

        return $weatherForecast->getContent();
    }
}