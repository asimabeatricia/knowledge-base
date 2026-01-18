<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\RequestException;
use Google_Client;

class Chatbot extends BaseController
{
    public function index()
    {
        return view('chatbot');
    }

    public function sendMessage()
    {
        try {
            $text = $this->request->getPost('message');
            $projectId = 'knowledge-base-453916';

            $sessionId = uniqid();
            $languageCode = 'id';

            $client = new GuzzleClient([
                'base_uri' => 'https://dialogflow.googleapis.com/v2/'
            ]);

            $url = "projects/$projectId/agent/sessions/$sessionId:detectIntent";

            $response = $client->post($url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->getAccessToken(),
                    'Content-Type'  => 'application/json',
                ],
                'json' => [
                    'queryInput' => [
                        'text' => [
                            'text' => $text,
                            'languageCode' => $languageCode,
                        ]
                    ]
                ]
            ]);

            $body = json_decode($response->getBody(), true);
            $reply = $body['queryResult']['fulfillmentText'] ?? 'Sorry, there is no answer.';
            $reply = nl2br($reply);

            return $this->response->setJSON(['reply' => $reply]);
        } catch (\Throwable $e) {
            log_message('error', 'Chatbot Error: ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON([
                'error' => $e->getMessage()
            ]);
        }
    }

    // take access token from service account
    private function getAccessToken()
    {
        $jsonKeyPath = getenv('GOOGLE_APPLICATION_CREDENTIALS');
        if (!$jsonKeyPath || !file_exists($jsonKeyPath)) {
            throw new \Exception('Google application credentials not found.');
        }
        $client = new Google_Client();
        $client->useApplicationDefaultCredentials();
        $client->addScope('https://www.googleapis.com/auth/cloud-platform');

        $token = $client->fetchAccessTokenWithAssertion();
        return $token['access_token'];
    }
}
