<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Events\PostCreated;
use App\Listeners\StoreTimeToSessionWhenPostCreated;
use App\Post;
use Illuminate\Http\UploadedFile;
use Mockery;
use Illuminate\Contracts\Session\Session;

class EventListenerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testEventPostCreated()
    {
        $post = new Post([
            'title' => 'test',
            'content' => 'sgdfgsrt',
            'image' => UploadedFile::fake()->create('test.jpg', 1000),
        ]);

        $postTest = new PostCreated($post);
        $this->assertSame($post, $postTest->post);
    }

    public function testStoreTimeWhenPostCreated()
    {
    	$post = new Post([
            'title' => 'test',
            'content' => 'sgdfgsrt',
            'image' => UploadedFile::fake()->create('test.jpg', 1000),
        ]);

		$postTest = new PostCreated($post);

    	$session = Mockery::mock(Session::class);
        $time = new StoreTimeToSessionWhenPostCreated($session);

        $session->shouldReceive('put')->once()->with('test', Mockery::any());

        $this->assertNull($time->handle($postTest));
    }
}
