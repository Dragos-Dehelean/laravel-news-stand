<?php

namespace App\Mailers;

use App\User;
use PHPMailer\PHPMailer\PHPMailer; 

class AppMailer {
   
     
    /**
     * The Mailer instance.
     *
     * @var Mailer
     */
    protected $mailer;
     

    /**
     * Creates a new PHPMailer instance.
     *
     * @param Mailer $mailer
     */
    public function __construct(PHPMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Delivers the email confirmation
     *
     * @param  User $user
     * @return void
     */
    public function sendEmailConfirmationTo(User $user)
    {    
       
       $this->mailer->addAddress( $user->email, $user->name ); 
       $this->mailer->Subject = "Please verify your email address";
       $this->mailer->Body = view('emails.confirm', ['user' => $user] );

       $this->deliver();
    }

     /**
     * Delivers the email via Google SMTP
     *
     * @return void
     */
    public function deliver()
    {
        $this->mailer->isSMTP(); // tell to use smtp
        $this->mailer->SMTPDebug = 0; // 3 - full debugging:
        $this->mailer->SMTPAuth = true; // authentication enabled
        $this->mailer->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        $this->mailer->Host = "smtp.gmail.com";
        $this->mailer->Port = 465; // or 587        
        $this->mailer->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $this->mailer->Username = "Your.Newsstand@gmail.com";
        $this->mailer->Password = "newsyourstand";

        $this->mailer->SetFrom("Your.Newsstand@gmail.com", "Your Newsstand");       
        $this->mailer->IsHTML(true); 

        $this->mailer->send();
       
        
        /* // Alternate Debugging
        if (!$this->mailer->send()) {
            echo "Mailer Error: " . $this->mailer->ErrorInfo;
        } else {
            echo "Message sent!";
        }
        */

    }

    
}
