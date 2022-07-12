<?php
declare(strict_types=1);

namespace App\Controller;

use App\Service\CallApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @Route("/home", name="home")
     */
    public function index(CallApiService $callApiService): Response 
    {
        dd($callApiService->getApiData());
        return $callApiService->getApiData();
    }

}