<?php
// app/Libraries/DialogflowClient.php
namespace App\Libraries;

use Google\Auth\OAuth2;
use Google\Auth\ApplicationDefaultCredentials;
use GuzzleHttp\Client;

class DialogflowClient
{
    private $projectId;
    private $sessionId;
    private $client;
    private $accessToken;

    public function __construct()
    {
        $keyFilePath = WRITEPATH . 'keys/dialogflow-key.json'; // Pindahkan ke path aman

        $this->projectId = json_decode(file_get_contents($keyFilePath), true)['project_id'];
        $this->sessionId = session_id();

        $this->client = new Client(['base_uri' => 'https://dialogflow.googleapis.com/v2/']);
        $this->accessToken = $this->getAccessToken($keyFilePath);
    }

    private function getAccessToken($keyFilePath)
    {
        $credentials = json_decode(file_get_contents($keyFilePath), true);
        $auth = new \Google\Auth\Credentials\ServiceAccountCredentials(
            'https://www.googleapis.com/auth/cloud-platform',
            $credentials
        );
        $authArray = $auth->fetchAuthToken();
        return $authArray['access_token'];
    }

    public function detectIntent($message, $lang = 'id')
    {
        $url = "projects/{$this->projectId}/agent/sessions/{$this->sessionId}:detectIntent";

        $response = $this->client->post($url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'queryInput' => [
                    'text' => [
                        'text' => $message,
                        'languageCode' => $lang,
                    ]
                ]
            ]
        ]);

        $body = json_decode($response->getBody(), true);
        return $body['queryResult']['fulfillmentText'] ?? 'Maaf, saya tidak mengerti.';
    }
}
