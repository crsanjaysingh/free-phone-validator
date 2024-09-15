<?php

namespace App\Services;

use GuzzleHttp\Client;

class PhoneValidationService
{
  protected $apiKey;
  protected $baseUrl = 'https://www.ipqualityscore.com/api/json/phone';
  protected $client;

  public function __construct(Client $client)
  {
    $this->apiKey = config('services.ipqs.api_key');
    $this->client = $client;
  }

  public function validatePhone($phone, $countries = ['US', 'CA'])
  {
    $parameters = [
      'country' => $countries
    ];

    try {

      $url = sprintf(
        '%s/%s/%s',
        $this->baseUrl,
        $this->apiKey,
        $phone
      );

      $response = $this->client->get($url, [
        'query' => $parameters,
        'timeout' => 5,
      ]);

      if ($response->getStatusCode() === 200) {
        return json_decode($response->getBody()->getContents(), true);
      }
    } catch (\Exception $e) {
      return [
        'error' => true,
        'message' => $e->getMessage()
      ];
    }
    return null;
  }
}
