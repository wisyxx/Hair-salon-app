<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{

    public $email;
    public $name;
    public $token;

    public function __construct($email, $name, $token)
    {
        $this->email = $email;
        $this->name = $name;
        $this->token = $token;
    }

    public function sendConfirmation()
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '6eaf2962709815';
        $mail->Password = '52ddc773555877';

        $mail->setFrom('accounts@apphairsalon.com');
        $mail->addAddress('accounts@apphairsalon', 'apphairsalon.no');
        $mail->Subject = 'Verify your account';

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $content = '<html></html>';
        $content .= '<h1><strong>Hi ' . $this->name . '!</strong></h1>';
        $content .= '<p>
                        You created an account, 
                        to finish this process you need to verify your 
                        account by pressing the following link.
                    </p>';
        $content .= '<a href="localhost:3000/verify-account?token=' . $this->token . '">Verify</a>';
        $content .= '<p>
                        If it wasn\'t you, just ignore the message
                    </p>';

        $mail->Body = $content;
        
        $mail->send();
    }
}
