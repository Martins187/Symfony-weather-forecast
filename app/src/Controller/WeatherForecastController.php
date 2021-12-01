<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\WeatherForecast;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class WeatherForecastController 
{
    /**
     * @Route("/")
     * @Method({"GET"})
     */
    public function index()
    {
        $weatherForecast = (new WeatherForecast)->getData();

        return new Response($weatherForecast);
    }
}