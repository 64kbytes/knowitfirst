<?php

namespace Baytree\KnowItFirst\Listeners;

use Baytree\KnowItFirst\Events\UncaughtExceptionEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

//use \GuzzleHttp\Client as HTTPClient;

use Baytree\Slack\Client as Slack;
use Baytree\Slack\Message;
use Baytree\Slack\Attachment;
use Baytree\Slack\Field;

class SendMessageToSlack
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Slack $SlackClient)
    {
        //
        $this->slack = $SlackClient;
    }

    protected function getFormattedExceptionText($event)
    {
        return "'{$event->exception->getMessage()}'".PHP_EOL.
            "In file: {$event->exception->getFile()}".PHP_EOL.
            "In line {$event->exception->getLine()}";
    }

    /**
     * Handle the event.
     *
     * @param  UncaughtExceptionEvent  $event
     * @return void
     * @example
     * 
     * [
     *      "fallback" => "Required plain-text summary of the attachment.",
     *        "color" => "#36a64f",
     *       "pretext" => "Optional text that appears above the attachment block",
     *       "author_name" => "Bobby Tables",
     *       "author_link" => "http://flickr.com/bobby/",
     *       "author_icon" => "http://flickr.com/icons/bobby.jpg",
     *       "title" => "Slack API Documentation",
     *       "title_link" => "https://api.slack.com/",
     *       "text" => "Optional text that appears within the attachment",
     *       "fields" => [
     *           [
     *               "title" => "Priority",
     *               "value" => "High",
     *               "short" => false
     *           ]
     *       ],
     *       "image_url" => "http://my-website.com/path/to/image.jpg",
     *       "thumb_url" => "http://example.com/path/to/thumb.png",
     *       "footer" => "Slack API",
     *       "footer_icon" => "https://platform.slack-edge.com/img/default_application_icon.png",
     *       "ts" => 123456789
     *   ]
     */
    public function handle(UncaughtExceptionEvent $event)
    {   
        
        $message = new Message();
        $attachment = new Attachment();

        $exc_text = new Field();
        $exc_text->title('Message');
        $exc_text->value($event->getException()->getMessage());
        $exc_text->short(false);

        $exc_file = new Field();
        $exc_file->title('File');
        $exc_file->value($event->getException()->getFile());
        $exc_file->short(false);

        $exc_line = new Field();
        $exc_line->title('Line');
        $exc_line->value($event->getException()->getLine());
        $exc_line->short(true);

        $attachment->fallback($this->getFormattedExceptionText($event))
            ->pretext('KnowItFirst says:')
            ->author_name(\Config::get('app.name'))
            ->author_link(url('/'))
            ->title(get_class($event->exception))
            ->add_field($exc_text)
            ->add_field($exc_file)
            ->add_field($exc_line)
            ->color('#e51c19')
            ->footer($this->slack->getQuote());

        $message->add_attachment($attachment)->emoji(':gun:')->username(\Config::get('app.name'));
        $this->slack->send($message);
    }
}
