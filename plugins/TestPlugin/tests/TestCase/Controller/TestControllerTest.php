<?php
namespace TestPlugin\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use TestPlugin\Controller\TestController;

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
        $this->post([
            'plugin' => 'TestPlugin',
            'controller' => 'Test',
            'action' => 'index'
        ]);

        $this->assertResponseOk();
    }
}
