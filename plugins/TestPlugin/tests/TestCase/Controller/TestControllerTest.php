<?php
namespace TestPlugin\Test\TestCase\Controller;

use Cake\Routing\Router;
use Cake\TestSuite\IntegrationTestCase;
use TestPlugin\Controller\TestController;
use TestPlugin\Plugin;

/**
 * TestPlugin\Controller\TestController Test Case
 */
class TestControllerTest extends IntegrationTestCase
{

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->disableErrorHandlerMiddleware();
        $routes = Router::createRouteBuilder('/');
        $plugin = new Plugin();
        $plugin->routes($routes);

        $this->post([
            'plugin' => 'TestPlugin',
            'controller' => 'Test',
            'action' => 'index'
        ]);

        $this->assertResponseOk();
    }
}
