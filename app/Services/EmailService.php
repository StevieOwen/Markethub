<?php
namespace App\Services;
ob_start();
include __DIR__ . '/../Views/Emails/welcome.php';
$mail->Body = ob_get_clean();

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailService {
    protected $mail;

    public function __construct() {
        $this->mail = new PHPMailer(true);
        
        // Server settings
        $this->mail->isSMTP();
        $this->mail->Host       = $_ENV['MAIL_HOST'];
        $this->mail->SMTPAuth   = true;
        $this->mail->Username   = $_ENV['MAIL_USERNAME'];
        $this->mail->Password   = $_ENV['MAIL_PASSWORD'];
        $this->mail->SMTPSecure = $_ENV['MAIL_ENCRYPTION'] === 'tls' 
                                  ? PHPMailer::ENCRYPTION_STARTTLS 
                                  : PHPMailer::ENCRYPTION_SMTPS;
        $this->mail->Port       = $_ENV['MAIL_PORT'];

        // Default Sender
        $this->mail->setFrom($_ENV['MAIL_FROM_ADDRESS'], $_ENV['MAIL_FROM_NAME']);
    }

    public function sendWelcomeEmail($toEmail, $toName) {
        try {
            $this->mail->addAddress($toEmail, $toName);
            $this->mail->isHTML(true);
            $this->mail->Subject = 'Welcome to Market Hub!';
            
            // Example: Using a separate HTML file for the email body
            $this->mail->Body = "<h1>Welcome, $toName!</h1><p>Your account is ready.</p>";

            return $this->mail->send();
        } catch (Exception $e) {
            // Log the error for debugging
            error_log("Mailer Error: " . $this->mail->ErrorInfo);
            return false;
        }
    }
}