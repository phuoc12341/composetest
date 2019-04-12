<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\TestController;
use Mockery;

class StubTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testUnitTestExample()
    {
        // Create a stub for the SomeClass class.
        $stub = $this->createMock(TestController::class);

        // Configure the stub.
        $stub->method('showName')
             ->willReturn('OK');

        // Calling $stub->doSomething() will now return
        // 'foo'.
        $this->assertSame('OK', $stub->showName());
    }

    public function testMokeryExample()
    {
        $mock = Mockery::mock('TestController');
        $mock->shouldReceive('showName')
            ->once()
            ->andReturn("Toi la Ko Biet Choi");

        $controller = new TestController;
        $msg = $controller->showName();

        $this->assertSame($msg, $mock->showName());
    }
}
