<?php

namespace Baytree\KnowItFirst\Listeners;

use Baytree\KnowItFirst\Events\UncatchedExceptionThrown;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMessageToSlack
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UncatchedExceptionThrown  $event
     * @return void
     */
    public function handle(UncatchedExceptionThrown $event)
    {
        //
    }
}
