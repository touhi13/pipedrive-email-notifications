<?php

namespace App\Pipedrive;

use App\Email\Email;
use App\Email\Mailer;
use App\Pipedrive\PersonFetcher;

/**
 * Class WebhookHandler
 *
 * Handles the Pipedrive webhook payload and sends email notifications.
 */
class WebhookHandler
{
    /**
     * @var array The webhook payload data.
     */
    private $payload;

    /**
     * WebhookHandler constructor.
     *
     * @param string $payload The JSON payload received from the webhook.
     */
    public function __construct($payload)
    {
        $this->payload = json_decode($payload, true);
    }

    /**
     * Handles the webhook and sends email notifications.
     */
    public function handleWebhook()
    {
        $clientEmail = $this->fetchClientEmail(); // Retrieve the client's email address
        $dealTitle = $this->fetchDealTitle(); // Retrieve the title of the deal

        $email = new Email();
        $email->setTo($clientEmail); // Set the recipient email address
        $email->setSubject('New deal added in Pipedrive'); // Set the email subject
        $email->setMessage("Dear client,\n\nA new deal has been added in Pipedrive: $dealTitle"); // Compose the email message with the deal title
        $email->setFrom('noreply@democompany.com'); // Set the sender email address

        $mailer = new Mailer();
        $mailer->sendEmail($email); // Send the email using the Mailer class
    }
    
    /**
     * Fetches the client's email address from the Pipedrive API.
     *
     * @return string The client's email address.
     */
    private function fetchClientEmail()
    {
        $personId = $this->payload['current']['person_id']; // Retrieve the ID of the person associated with the deal
    
        $personFetcher = new PersonFetcher(); // Create an instance of the PersonFetcher class
        $personData = $personFetcher->fetchPerson($personId); // Fetch the person data using the person ID
    
        return $personData['email'][0]['value']; // Return the email address of the person
    }    

    /**
     * Fetches the title of the deal from the webhook payload.
     *
     * @return string The title of the deal.
     */
    private function fetchDealTitle()
    {
        return $this->payload['current']['title'];
    }
}
