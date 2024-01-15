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
        $mail->Username = '35ba6cecf041f5';
        $mail->Password = 'e592a46b44fab9';

        $mail->setFrom('accounts@apphairsalon.no');
        $mail->addAddress('accounts@apphairsalon.no', 'apphairsalon.no');
        $mail->Subject = 'Verify your account';

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $content = '<html></html>';
        $content .= '<h1><strong>Hi ' . $this->name . '!</strong></h1>';
        $content .= '<p>
                        You created an account in our app, 
                        to finish this process you need to verify your 
                        account by pressing the following link.
                    </p>';
        $content .= '<a target="_self" href="localhost:3000/verify-account?token=' . $this->token . '">Verify here</a>';
        $content .= '<p>
                        If it wasn\'t you, just ignore the message
                    </p>';

        $mail->Body = $content;
        
        $mail->send();
    }

    public function sendInstructions() {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '35ba6cecf041f5';
        $mail->Password = 'e592a46b44fab9';

        $mail->setFrom('accounts@apphairsalon.no');
        $mail->addAddress('accounts@apphairsalon.no', 'apphairsalon.no');
        $mail->Subject = 'Reset your password';

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $content = '<html></html>';
        $content .= '<h1><strong>Hi ' . $this->name . '!</strong></h1>';
        $content .= '<p>
                        You requested to reset your password, 
                        press the following link to finish this 
                        process.
                    </p>';
        $content .= '<a target="_self" href="localhost:3000/reset?token=' . $this->token . '">Reset password</a>';
        $content .= '<p>
                        If it wasn\'t you, just ignore the message
                    </p>';

        $mail->Body = $content;

        $mail->send();
    }
}
