<?php

namespace Baytree\KnowItFirst\Listeners;

use Baytree\KnowItFirst\Events\UncatchedExceptionThrown;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use \GuzzleHttp\Client as HTTPClient;

class SendMessageToSlack
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(HTTPClient $HTTPClient)
    {
        //
        $this->http = new $HTTPClient;
    }

    /**
     * Handle the event.
     *
     * @param  UncatchedExceptionThrown  $event
     * @return void
     */
    public function handle(UncatchedExceptionThrown $event)
    {   

        $message = $event->exception->getMessage();
        $file = $event->exception->getFile();
        $code = $event->exception->getCode();
        $line = $event->exception->getLine();
        $original = (string) $event->exception;

        $r = $this->http->post('https://hooks.slack.com/services/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', [
            'json' => [
                "text" => $message.' at '.$file
            ]
        ]);

    }
}
