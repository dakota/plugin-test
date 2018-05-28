<?php
namespace TestPlugin\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;

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

        $this->get([
            '_name' => 'Test'
        ]);

        $this->assertResponseOk();
        $this->assertResponseContains('Hello');
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndexPost()
    {
        $this->disableErrorHandlerMiddleware();

        $this->post([
            '_name' => 'Test'
        ]);

        $this->assertResponseOk();
        $this->assertResponseContains('Hello');
    }
}
