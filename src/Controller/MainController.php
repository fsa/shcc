<?php

namespace App\Controller;

use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/')]
    function index(Request $request): Response
    {
        $ip = $request->getClientIp();
        return new Response(
            "<html><body>Client IP: $ip, Timezone: " . timezone_name_get(date_timezone_get(new DateTimeImmutable())) . '</body></html>'
        );
    }
}
