<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExplanationFromUserBlockedMail extends Mailable
{
    use Queueable, SerializesModels;

    private $data;

    /**
     * ExplanationFromUserBlockedMail constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return ExplanationFromUserBlockedMail
     */
    public function build()
    {
        return $this
            ->to("artyrkaartyrka@yandex.ru", 'Блокировка пользователя')
            ->subject('Сообщение от пользователя')
            ->view('mail.explanationUser')
            ->with([
                'data' => $this->data,
            ]);
    }
}
