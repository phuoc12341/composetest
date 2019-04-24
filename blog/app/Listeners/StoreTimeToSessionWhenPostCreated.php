<?php

namespace App\Listeners;

use App\Events\PostCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;

class StoreTimeToSessionWhenPostCreated
{

    public $session;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * Handle the event.
     *
     * @param  PostCreated  $event
     * @return void
     */
    public function handle(PostCreated $event)
    {
        $this->session->put($event->post->title, Carbon::now());
    }
}
