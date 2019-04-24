<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Middleware\ComplexMiddleware;

class ComplexMiddlewareTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testMiddlewareAppendDataToSession()
    {
        $session = Mockery::mock(SessionInterface::class);
        $request = new Request();
        $request->headers->set('Test', 'true');
        $request->setLaravelSession($session);

        $started = null;
        $ended = null;
        $session->shouldReceive('set')
            ->once()
            ->with('Test-Started', Mockery::any())
            ->andReturnUsing(function ($key, $value) use ($started) {
                $started = $value;
    		});

    	$session->shouldReceive('set')
            ->once()
            ->with('Test-Ended', Mockery::any())
            ->andReturnUsing(function ($key, $value) use ($ended) {
                $ended = $value;
            });

        $next = function () {
            return 'foo';
        };

        $complexMiddleware = new ComplexMiddleware();

        $response = $complexMiddleware->handle($request, $next);
        $this->assertEquals('foo', $response);
        $this->assertGreaterThanOrEqual($started, $ended);
    }

    public function testMiddlewareNotModifySessionWithoutHeader()
    {
        $session = Mockery::mock(SessionInterface::class);
        $request = new Request();
        $request->setLaravelSession($session);
        $session->shouldNotReceive('set');
        $session->shouldReceive('get');

        $next = function () {
            return 'bar';
        };

        $complexMiddleware = new ComplexMiddleware();
        $response = $complexMiddleware->handle($request, $next);
        $this->assertEquals('bar', $response);
        $sessionOfRequest = $request->getSession()->get('Test-Ended');
        $this->assertNull($sessionOfRequest);
    }

    public function testMiddlewareAbortIfNoSession()
    {
        $request = new Request();
        $next = function () {
            return false;
        };

        $complexMiddleware = new ComplexMiddleware();
        $response = $complexMiddleware->handle($request, $next);

        $this->assertEquals('Session Does Not Exist.', $response->content());
        $this->assertEquals(500, $response->status());
    }
}
