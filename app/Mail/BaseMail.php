<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Utilizo un Mail Laravel como base para generar todos
 * los correos dinamicamente
 *
 * @author Emilio Ochoa <emilioaor@gmail.com>
 */
class BaseMail extends Mailable
{
    use Queueable, SerializesModels;

    public $view;
    public $recipients;
    public $params;

    /**
     * Create a new message instance.
     *
     * @param string $view
     * @param array $recipients
     * @param array $params
     */
    public function __construct($view, array $recipients, array $params)
    {
        $this->view = $view;
        $this->recipients = $recipients;
        $this->params = $params;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view($this->view, $this->params)->to($this->recipients);
    }
}
