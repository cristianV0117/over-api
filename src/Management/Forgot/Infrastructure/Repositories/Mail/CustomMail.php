<?php

declare(strict_types=1);

namespace Src\Management\Forgot\Infrastructure\Repositories\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Src\Management\Forgot\Infrastructure\Mail\Mail\Demo;

final class CustomMail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * The demo object instance.
     *
     * @var Demo
     */
    public $demo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($demo)
    {
        $this->demo = $demo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): CustomMail
    {
        return $this->from($this->demo->from)
            ->subject($this->demo->subject)
            ->with('webDomain', $this->demo->resetPassword)
            ->markdown($this->demo->markdown);
    }
}
