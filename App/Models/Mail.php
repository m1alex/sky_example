<?php

namespace App\Models;

use \Exception;
use PHPMailer\PHPMailer\PHPMailer;

/**
 * mail model
 */
class Mail
{
    /**
          * 
          * @param string $to
          * @param string $username
          * @param string $subject
          * @param string $template
          * @param array $placeholders
          * @return type
          */
    public static function send(string $to, string $username, string $subject, string $template, array $placeholders)
    {
        $html = self::message($template, $placeholders);
        // echo("<hr>$html");

        return self::process($to, $username, $subject, $html);
    }
    
    
    /**
          * 
          * @param string $template
          * @param array $placeholders
          * @return type
          * @throws Exception
          */
    protected static function message(string $template, array $placeholders)
    {
        $paths = explode('.', $template);
        
        $layoutFile = ROOTPATH . 
                DIRECTORY_SEPARATOR . 'App' .
                DIRECTORY_SEPARATOR . "layouts/email.php";
                
        $templateFile = ROOTPATH . 
                DIRECTORY_SEPARATOR . 'App' .
                DIRECTORY_SEPARATOR . 'templates' .
                DIRECTORY_SEPARATOR . $paths[0] .
                DIRECTORY_SEPARATOR . $paths[1] . '.php';
        
        try {
            extract($placeholders);
        
            ob_start();
            require $templateFile;
            $body = ob_get_clean();
            ob_end_clean();
            
            ob_start();
            require $layoutFile;
            $html = ob_get_clean();
        } catch (Exception $ex) {
            throw new Exception("Template rendering fails");
        }
        
        return $html;
    }
    
    
    /**
          * 
          * @param string $to
          * @param string $username
          * @param string $subject
          * @param string $html
          */
    protected static function process(string $to, string $username, string $subject, string $html)
    {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Mailer = "smtp";
        $mail->Host = $_ENV['MAIL_SMTP_HOST'];
        $mail->Port = $_ENV['MAIL_SMTP_PORT'];
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = $_ENV['MAIL_SMTP_ENCRYPTION'];
        $mail->Username = $_ENV['MAIL_SMTP_USERNAME'];
        $mail->Password = $_ENV['MAIL_SMTP_PASSWORD'];

        $mail->From = $_ENV['MAIL_FROM_ADDRESS'];
        $mail->FromName = $_ENV['MAIL_FROM_NAME'];
        $mail->AddAddress($to, $username);

        $mail->Subject = $subject;
        $mail->Body = $html;
        $mail->isHTML(true); 

        if(!$mail->send()) {
            var_dump($mail);
            die($mail->ErrorInfo);
            return false;
        } else {
            return true;
        }
    }
}
