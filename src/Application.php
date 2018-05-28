<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     3.3.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App;

use Cake\Core\Configure;
use Cake\Error\Middleware\ErrorHandlerMiddleware;
use Cake\Http\BaseApplication;
use Cake\Routing\Middleware\AssetMiddleware;
use Cake\Routing\Middleware\RoutingMiddleware;
use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

/**
 * Application setup class.
 *
 * This defines the bootstrapping logic and middleware layers you
 * want to use in your application.
 */
class Application extends BaseApplication
{
    /**
     * {@inheritDoc}
     */
    public function bootstrap()
    {
        // Call parent to load bootstrap from files.
        parent::bootstrap();
    }

    public function routes($routes)
    {
        Router::defaultRouteClass(DashedRoute::class);

        $routes->scope('/', function (RouteBuilder $routes) {
            /**
             * Here, we are connecting '/' (base path) to a controller called 'Pages',
             * its action called 'display', and we pass a param to select the view file
             * to use (in this case, src/Template/Pages/home.ctp)...
             */
            $routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);

            /**
             * ...and connect the rest of 'Pages' controller's URLs.
             */
            $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);

            /**
             * Connect catchall routes for all controllers.
             *
             * Using the argument `DashedRoute`, the `fallbacks` method is a shortcut for
             *    `$routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);`
             *    `$routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);`
             *
             * Any route class can be used with this method, such as:
             * - DashedRoute
             * - InflectedRoute
             * - Route
             * - Or your own route class
             *
             * You can remove these routes once you've connected the
             * routes you want in your application.
             */
            $routes->fallbacks(DashedRoute::class);
        });
    }

    /**
     * Setup the middleware queue your application will use.
     *
     * @param \Cake\Http\MiddlewareQueue $middlewareQueue The middleware queue to setup.
     * @return \Cake\Http\MiddlewareQueue The updated middleware queue.
     */
    public function middleware($middlewareQueue)
    {
        $middlewareQueue
            // Catch any exceptions in the lower layers,
            // and make an error page/response
            ->add(ErrorHandlerMiddleware::class)

            // Handle plugin/theme assets like CakePHP normally does.
            ->add(AssetMiddleware::class)

            // Add routing middleware.
            // Routes collection cache enabled by default, to disable route caching
            // pass null as cacheConfig, example: `new RoutingMiddleware($this)`
            // you might want to disable this cache in case your routing is extremely simple
            ->add(new RoutingMiddleware($this));

        return $middlewareQueue;
    }
}
