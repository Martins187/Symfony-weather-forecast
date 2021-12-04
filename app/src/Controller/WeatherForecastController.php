<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Service\WeatherForecastService;
use App\Service\IpAddressService;
use App\Service\LocationService;

class WeatherForecastController extends AbstractController
{
    /**
     * @Route("/", name="index", methods="GET")
     */
    public function index(): Response
    {
        $ip              = (new IpAddressService)->getIp();
        $cityName        = (new LocationService)->getCityName($ip);
        $weatherForecast = (new WeatherForecastService)->getForecast($cityName);

        return new Response($weatherForecast);
    }

     /**
     * @Route("/renewData", name="renewForecastData", methods="GET")
     */
    public function renewForecastData(): RedirectResponse
    {
        (new IpAddressService)->clearCachedIp();
        (new LocationService)->clearCachedCityName();

        return $this->redirectToRoute('index');
    }
}