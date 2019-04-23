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
        $this->assertEquals(route('posts.index'), $view->headers->get('Location'));
    }

    public function testUpdatePost()
    {
        $request = new Request();
        $controller = new PostController();

        $controller->index($request);

        $data = [
            'title' => 'Gia vang',
            'content' => 'Dang giam',
        ];

        $request->headers->set('content-type', 'application/json');
        $request->setJson(new ParameterBag($data));

        $view = $controller->update($request, 2);
        $this->assertEquals(route('posts.index'), $view->headers->get('Location'));
    }

    function testDeletePost()
    {
        $request = new Request();
        $controller = new PostController();

        $controller->index($request);

        $request->headers->set('content-type', 'application/json');

        $view = $controller->destroy(5);
        $this->assertEquals(route('posts.index'), $view->headers->get('Location'));
    }
}
