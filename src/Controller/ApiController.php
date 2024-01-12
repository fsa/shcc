<?php

namespace App\Controller;

use ShccFramework\Plugins;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route('/api/daemon/{name}')]
    function getDaemon(string $name, Plugins $plugins): Response
    {
        $plugin_info = $plugins->getPlugin($name);
        if (!$plugin_info) {
            return $this->json(['error' => 'Plugin not found'], 400);
        }
        if (!isset($plugin_info->daemon)) {
            return $this->json(['error' => 'Plugin Daemon not found'], 400);
        }
        return $this->json([
            'daemon' => $plugin_info->daemon,
            'settings' => isset($plugin_info->settings) ? array_merge((array)$plugin_info->settings, []) : []
        ]);
    }
}
