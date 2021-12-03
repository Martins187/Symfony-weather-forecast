<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\WeatherForecastProviders\WeatherProviderInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Service\WeatherForecastService;
use App\Service\IpAddressService;
use App\Service\LocationService;

class WeatherForecastController extends AbstractController
{
    public function __construct(
        private IpAddressService $ipAddressService,
        private LocationService $locationService,
        private WeatherForecastService $weatherForecastService
    ){}
    

    /**
     * @Route("/", name="index", methods="GET")
     */
    public function index(WeatherProviderInterface $weatherProvider): Response
    {
        $ip = $this->ipAddressService->getIp();
        $cityName = $this->locationService->getCityName($ip);
        $weatherForecast = $this->weatherForecastService->getForecast($weatherProvider, $cityName);

        return new Response($weatherForecast);
    }

     /**
     * @Route("/renewData", name="renewForecastData", methods="GET")
     */
    public function renewForecastData() : Response
    {
        $this->ipAddressService->clearCachedIp();
        $this->locationService->clearCachedCityName();
        return $this->index();
    }
}