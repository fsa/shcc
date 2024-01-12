<?php

namespace App\Controller;

use ShccFramework\PluginRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route('/api/daemon/{name}')]
    function getDaemon(string $name, PluginRepository $pluginRepository, ParameterBagInterface $parameterBag): Response
    {
        $plugin_info = $pluginRepository->find($name);
        if ($plugin_info === null) {
            return $this->json(['error' => 'Plugin not found'], 400);
        }
        $daemon = $plugin_info->getDaemon();
        if ($daemon === null) {
            return $this->json(['error' => 'Plugin Daemon not found'], 400);
        }
        $default_settings = $plugin_info->getSettings();
        $settings = $parameterBag->has('shcc.daemon.'.$name)? $parameterBag->get('shcc.daemon.' . $name):[];

        return $this->json([
            'daemon' => $daemon,
            'settings' => $settings ? array_merge($default_settings, $settings) : $default_settings
        ]);
    }
}
