<?php
namespace App\Controller;

use App\Util\TestTZ;
use Doctrine\DBAL\Connection;
use FSA\SmartHome\Plugins;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/')]
    function index(Request $request, TestTZ $testTZ): Response
    {
        $ip = $request->getClientIp();
        return new Response(
            "<html><body>Client IP: $ip, Timezone: ".$testTZ->get().'</body></html>'
        );
    }

    #[Route('/test')]
    function test(Connection $connection)
    {
        dd($connection->fetchAssociative('select * from users where login=?', ['fsa']));
    }
}