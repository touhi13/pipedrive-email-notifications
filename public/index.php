<?php

require_once '../vendor/autoload.php';

use App\Pipedrive\WebhookHandler;

// Assuming you receive the webhook payload
$payload = file_get_contents('php://input');
// file_put_contents('deal.json', $payload . PHP_EOL, FILE_APPEND); // Save the webhook payload to a file for logging purposes

$webhookHandler = new WebhookHandler($payload);
$webhookHandler->handleWebhook(); // Process the webhook payload using the WebhookHandler class


