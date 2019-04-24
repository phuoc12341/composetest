<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repository\CommentRepository;
use App\Repository\CommentRepositoryInterface;
use Illuminate\Container\Container;
use App\Providers\RepositoryServiceProvider;

class AppServiceProviderTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testAppRegisterCommentRepository()
    {
        $container = new Container();
        $provider = new RepositoryServiceProvider($container);

        $provider->register();
        $this->assertTrue($container->bound(CommentRepositoryInterface::class));

        $comment = $container->make(CommentRepositoryInterface::class);
        $this->assertEquals($comment, $container->make(CommentRepositoryInterface::class));
    }
}
