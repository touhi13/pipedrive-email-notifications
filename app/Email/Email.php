<?php

namespace App\Email;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Email
{
    /** @var string The recipient email address */
    private $to;

    /** @var string The email subject */
    private $subject;

    /** @var string The email message */
    private $message;

    /** @var string The sender email address */
    private $from;

    /**
     * Set the recipient email address.
     *
     * @param string $to The recipient email address.
     * @return void
     */
    public function setTo($to)
    {
        $this->to = $to;
    }

    /**
     * Set the email subject.
     *
     * @param string $subject The email subject.
     * @return void
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * Set the email message.
     *
     * @param string $message The email message.
     * @return void
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * Set the sender email address.
     *
     * @param string $from The sender email address.
     * @return void
     */
    public function setFrom($from)
    {
        $this->from = $from;
    }

    /**
     * Send the email using PHPMailer.
     *
     * @return void
     */
    public function send()
    {
        $mail = new PHPMailer(true);

        try {
            // Configure your SMTP settings
            $mail->isSMTP();
            $mail->Host = 'localhost';
            $mail->Port = 1025;

            // Set email content
            $mail->setFrom($this->from);
            $mail->addAddress($this->to);
            $mail->Subject = $this->subject;
            $mail->Body = $this->message;

            // Send the email
            $mail->send();
            echo 'Email sent successfully.';
        } catch (Exception $e) {
            echo 'Failed to send the email. Error: ' . $mail->ErrorInfo;
        }
    }
}
