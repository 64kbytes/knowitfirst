<?php

namespace Baytree\KnowItFirst\Listeners;

use Baytree\KnowItFirst\Events\UncaughtExceptionEvent;
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
     * @param  UncaughtExceptionEvent  $event
     * @return void
     */
    public function handle(UncaughtExceptionEvent $event)
    {   

        $r = $this->http->post('https://hooks.slack.com/services/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', [
            'json' => [
                "text" => "This is a test message",
                //"channel" => "#devops",
                "link_names" => 1, 
                "username" => "myacobs", 
                "icon_emoji" => ":monkey_face:"
            ]
        ]);
    }
}
