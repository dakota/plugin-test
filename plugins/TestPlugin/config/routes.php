<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

$routes->plugin(
    'TestPlugin',
    ['path' => '/test-plugin'],
    function (RouteBuilder $routes) {
        $routes->connect('/test', ['controller' => 'Test', 'action' => 'index'], ['_name' => 'Test']);

        $routes->fallbacks(DashedRoute::class);
    }
);
