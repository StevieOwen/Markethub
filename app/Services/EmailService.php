<?php
namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailService {
    protected $mail;

    public function __construct() {
        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
        $this->mail->Host       = $_ENV['MAIL_HOST'];
        $this->mail->SMTPAuth   = true;
        $this->mail->Username   = $_ENV['MAIL_USERNAME'];
        $this->mail->Password   = $_ENV['MAIL_PASSWORD'];
        $this->mail->SMTPSecure = $_ENV['MAIL_ENCRYPTION'] === 'tls' 
                                  ? PHPMailer::ENCRYPTION_STARTTLS 
                                  : PHPMailer::ENCRYPTION_SMTPS;
        $this->mail->Port       = $_ENV['MAIL_PORT'];
        $this->mail->setFrom($_ENV['MAIL_FROM_ADDRESS'], $_ENV['MAIL_FROM_NAME']);
    }

    /**
     * @param string $toEmail Recipient email
     * @param string $subject Email subject
     * @param string $template The filename in Views/Emails/ (e.g., 'welcome')
     * @param array $data Associative array of variables to pass to the template
     */
    public function send($toEmail, $subject, $template, $data = []) {
        try {
            $this->mail->clearAddresses();
            $this->mail->addAddress($toEmail);
            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;

            // Extract the array so variables like $token or $name are available in the view
            extract($data);

            ob_start();
            $templatePath = __DIR__ . "/../Views/Emails/{$template}.php";
            if (file_exists($templatePath)) {
                include $templatePath;
            } else {
                throw new \Exception("Email template {$template} not found.");
            }
            $this->mail->Body = ob_get_clean();

            return $this->mail->send();
        } catch (Exception $e) {
            error_log("Mailer Error: " . $this->mail->ErrorInfo);
            return false;
        }
    }
}