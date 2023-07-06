<?php

namespace App\Pipedrive;

/**
 * Class PersonFetcher
 * Fetches person data from the Pipedrive API.
 */
class PersonFetcher
{
    /**
     * Fetches person data using the provided person ID.
     *
     * @param int $personId The ID of the person.
     * @return array|null The person data as an associative array, or null if fetching failed.
     */
    public function fetchPerson($personId)
    {
        $apiToken = '4d97b136802ffce0d537d361e5e0849763bbeaa4'; // API token for authentication
        $apiUrl = 'https://democompany.pipedrive.com/api/v1/persons/' . $personId . '?api_token=' . $apiToken; // API URL to fetch person data

        $ch = curl_init($apiUrl); // Initialize a cURL session with the API URL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Set cURL options to return the response as a string

        $response = curl_exec($ch); // Execute the cURL request and store the response
        curl_close($ch); // Close the cURL session

        // file_put_contents('person.json', $response . PHP_EOL, FILE_APPEND); // Save the API response to a file for logging purposes

        return json_decode($response, true)['data']; // Decode the JSON response and return the 'data' field
    }
}


