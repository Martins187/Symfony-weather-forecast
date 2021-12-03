<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Service\WeatherProviderInterface;
use App\Service\WeatherForecastService;
use App\Service\IpAddressService;
use App\Service\LocationService;

class WeatherForecastController extends AbstractController
{
    public function __construct(
        // private IpAddressService $ipAddressService,
        // private LocationService $locationService,
        // private WeatherForecastService $weatherForecastService
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
    public function renewForecastData() : RedirectResponse
    {
        $this->ipAddressService->clearCachedIp();
        $this->locationService->clearCachedCityName();
        return $this->redirectToRoute('index');
    }
}