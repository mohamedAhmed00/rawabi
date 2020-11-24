<?php
namespace App\Application\Tests\Feature;

use App\Application\Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/home');

        $response->assertStatus(200);
    }
}
