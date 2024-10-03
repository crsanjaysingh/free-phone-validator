<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Models\ApiResponse;
use App\Services\ApiResponseService;
use Illuminate\Support\Facades\Auth;

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

  public function validatePhone($lookup_for, $userId = null, $countries = ['US', 'CA'])
  {

    try {

      $parameters = [
        'country' => $countries
      ];
      $user_id = ($userId ?? Auth::id()) ?? null;
      $ApiResponseService = new ApiResponseService();
      $ApiResponse = $ApiResponseService->getResponse('phone', $lookup_for);

      if (!empty($ApiResponse->response_data)) {
        $this->updateLookupHistory($lookupType = 'phone', $lookup_for, $ApiResponse->response_data, $user_id);
        return $data = [
          "doNotUpdate" => true,
          "response_data" => json_decode($ApiResponse->response_data, true)
        ];
      } else {
        $url = sprintf(
          '%s/%s/%s',
          $this->baseUrl,
          $this->apiKey,
          $lookup_for
        );

        $response = $this->client->get($url, [
          'query' => $parameters,
          'timeout' => 5,
        ]);

        if ($response->getStatusCode() === 200) {

          $result = $response->getBody()->getContents();
          $this->updateLookupHistory($lookupType = 'phone', $lookup_for, $result, $user_id);
          $ApiResponseService->storeResponse('phone', $lookup_for, $result);
          return json_decode($result, true);
        }
      }
    } catch (\Exception $e) {

      return [
        'error' => true,
        'message' => $e->getMessage()
      ];
    }
    return null;
  }

  public function updateLookupHistory($lookupType = 'phone', $lookup_for, $result, $user_id)
  {
    $ApiResponseService = new ApiResponseService();
    $ApiResponse = $ApiResponseService->updateLookupHistory($lookupType, $lookup_for, $result, $user_id);
  }
}
