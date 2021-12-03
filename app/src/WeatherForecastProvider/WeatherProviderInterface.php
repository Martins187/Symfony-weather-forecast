<?php

namespace App\WeatherForecastProviders;

interface WeatherProviderInterface
{
    public function getForecast();
}