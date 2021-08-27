<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class sendEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The demo object instance.
     *
     * @var JSC Email Mailable
     */
    public $mail;
 
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($thisMail)
    {
        $this->mail = $thisMail;
    }
 
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->mail->purpose == "Subscribe"){
        return $this->subject('Subscription')->view('mails.index')
                    ->with('maildata', $this->mail);
        }
        elseif($this->mail->purpose == "Contact"){
        return $this->subject($this->mail->purpose)->view('mails.contact')
                    ->with('maildata', $this->mail);
        }        
        elseif($this->mail->purpose == "Contact Info"){
        return $this->subject($this->mail->purpose)->view('mails.contactinfo')
                    ->with('maildata', $this->mail);
        }                       
        elseif($this->mail->purpose == "New User"){
        return $this->subject('Account Creation')->view('mails.new')
                    ->with('maildata', $this->mail);
        }        
        elseif($this->mail->purpose == "Activate"){
        return $this->subject('Account Activation')->view('mails.activate')
                    ->with('maildata', $this->mail);
        }         
        elseif($this->mail->purpose == "Deactivate"){
        return $this->subject('Account Deactivation')->view('mails.deactivate')
                    ->with('maildata', $this->mail);
        }                
        elseif($this->mail->purpose == "Reset"){    
        return $this->subject('Password Reset')->view('mails.reset')
                    ->with('maildata', $this->mail);
        }        
        elseif($this->mail->purpose == "Reset Success"){
        return $this->subject('Password Reset Success')->view('mails.resetsuccess')
                    ->with('maildata', $this->mail);
        }
        elseif($this->mail->purpose == "Finish"){
        return $this->subject('ON-BOARDING COMPLETED')->view('mails.finish')
                    ->with('maildata', $this->mail);
        }       
    }
}