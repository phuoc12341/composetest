<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\PostController;
use Mockery;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\ParameterBag;

class PostTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreatePost()
    {
        $request = new Request();
        $controller = new PostController();

        $controller->index($request);

        $data = [
            'title' => 'Bong da',
            'content' => 'Barca vs Real',
        ];

        $request->headers->set('content-type', 'application/json');
        $request->setJson(new ParameterBag($data));

        $view = $controller->store($request);
        $this->assertEquals(route('home'), $view->headers->get('Location'));
    }
}
