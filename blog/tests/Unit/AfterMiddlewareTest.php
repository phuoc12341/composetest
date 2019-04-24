<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Middleware\AfterMiddleware;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AfterMiddlewareTest extends TestCase
{
    public function testAfterMiddlewareAppendToHeader()
    {
        $request = new Request();
        $next = function () {
        	return new Response();
        };

        $afterMiddleware = new AfterMiddleware();
        $response = $afterMiddleware->handle($request, $next);

        $this->assertNotEmpty($response->headers->get('Test'));
    }
}
