<?php
namespace App\Domain\User\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUsMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name , $email, $phone)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('site.mail.contact' ,['username' => $this->name , 'useremail' => $this->email , 'userphone' => $this->phone])
            ->subject('contact us')
            ->from(env('MESSAGE_SEND_TO_ADDRESS') , 'contact us');
    }
}
