<?php

namespace App\Services;

use GuzzleHttp\Client;

class OpenAIService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'https://api.openai.com/v1/']);
        $this->apiKey = env('OPENAI_API_KEY');
    }

    public function generateContent($prompt, $maxTokens = 100, $temperature = 0.7)
    {
        $response = $this->client->post('chat/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => 'gpt-3.5-turbo', // Use gpt-3.5-turbo instead of gpt-4
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                    ['role' => 'user', 'content' => $prompt],
                ],
                'max_tokens' => $maxTokens,
                'temperature' => $temperature,
            ],
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }
}
