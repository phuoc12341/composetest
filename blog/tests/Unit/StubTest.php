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
        $stub = $this->createMock(TestController::class);

        $stub->method('showName')
             ->willReturn('OK');

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
