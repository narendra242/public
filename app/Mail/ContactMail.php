<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable

{

    use Queueable, SerializesModels;



    /**

     * Create a new message instance.

     *

     * @return void

     */

    public function __construct($array)

    {

        $this->data = $array;

    }



    /**

     * Build the message.

     *

     * @return $this

     */

    public function build()

    {

        $data = $this->data;

        return $this->from('info@thehvecloset.com',$data['name'])->replyTo($data['email'],$data['name'])->view('mail.contact-templete',compact('data'))->subject($data['subject']);

    }

}
