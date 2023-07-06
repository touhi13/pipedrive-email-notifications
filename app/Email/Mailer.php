<?php

namespace App\Email;

/**
 * Class Mailer
 * Sends an email using the provided Email object.
 */
class Mailer
{
    /**
     * Sends an email.
     *
     * @param Email $email The Email object representing the email to be sent.
     * @return void
     */
    public function sendEmail(Email $email)
    {
        $email->send(); // Call the 'send()' method of the Email object to send the email
    }
}


