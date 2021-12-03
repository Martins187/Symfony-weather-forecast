<?php

namespace App\Service;

interface WeatherProviderInterface
{
    public function getForecast(string $city);
}