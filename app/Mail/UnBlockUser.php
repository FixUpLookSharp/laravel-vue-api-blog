<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UnBlockUser extends Mailable
{
    use Queueable, SerializesModels;

    private $data;

    /**
     * UnBlockUser constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return UnBlockUser
     */
    public function build()
    {
        return $this
            ->to($this->data['email'], 'Вы разблокированы')
            ->subject('Сообщение от администратора Blogs')
            ->view('mail.unblock')
            ->with([
                'unblockUser' => $this->data['text'],
            ]);
    }
}
