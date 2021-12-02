<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Services\WeatherForecastService;
use App\Services\IpAddressService;
use App\Services\LocationService;

class WeatherForecastController extends AbstractController
{
    /**
     * @Route("/", name="index", methods="GET")
     */
    public function index() : Response
    {
        $ip = (new IpAddressService)->getIp();
        $cityName = (new LocationService)->getCityName($ip);
        $weatherForecast = (new WeatherForecastService)->getForecast($cityName);

        return new Response($weatherForecast);
    }
}