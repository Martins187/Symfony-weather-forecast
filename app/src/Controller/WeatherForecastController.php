<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Services\WeatherForecastService;
use App\Services\IpAddressService;
use App\Services\LocationService;

class WeatherForecastController
{
    /**
     * @Route("/")
     * @Method({"GET"})
     */
    public function index() 
    {
        $ip = (new IpAddressService)->getIp();
        $cityName = (new LocationService)->getCityName($ip);
        $weatherForecast = (new WeatherForecastService)->getForecast($cityName);

        return new Response($weatherForecast);
    }
}