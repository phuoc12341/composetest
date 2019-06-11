<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Middleware\BeforeMiddleware;

class BeforeMiddlewareTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testBeforeMiddleware()
    {
        $request = new Request();
        $request->headers->set('Test', 'Phuoc');

        $next = function ($request) {
            $this->assertNull($request->headers->get('Test'));

            return 'foo';
        };

        $beforeMiddleware = new BeforeMiddleware();
        $response = $beforeMiddleware->handle($request, $next);
        $this->assertEquals('foo', $response);
    }

    public function testMiddlewareAbortOnWrongHeader()
    {
        $request = new Request();
        $request->headers->set('Test', 'abort');

        $next = function () {
            return true;
        };

        $beforeMiddleware = new BeforeMiddleware();
        $response = $beforeMiddleware->handle($request, $next);
        $this->assertEquals('Request Aborted', $response->content());
        $this->assertEquals(400, $response->status());
    }
}
