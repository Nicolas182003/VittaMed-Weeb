<?php

namespace App\Services;

use Google\Client as GoogleClient;
use Illuminate\Support\Facades\Http;

class FirebaseService {
    private string $projectId;
    private string $credentials;

    public function __construct()
        {
            $this->credentials = storage_path("app/firebase/firebase-admin.json");
            $this->projectId = json_decode(file_get_contents($this->credentials))->project_id;
            
        }

        private function getAccessToken(): string
        {
            $client = new GoogleClient();
            $client->setAuthConfig($this->credentials);
            $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
            $accessToken = $client->fetchAccessTokenWithAssertion()['access_token'];
            return $accessToken;
        }

        public function sendNotification(string $token, string $title, string $body): array
        {
            $message = [
                'message' => [
                    'token' => $token,
                    'notification' => [
                        'title' => $title,
                        'body' => $body,
                    ],
                ],
            ];
            $url = "https://fcm.googleapis.com/v1/projects/{$this->projectId}/messages:send";
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->getAccessToken(),
                'Content-Type' => 'application/json',
            ])->post($url, $message);
            return $response->json();
        }
}