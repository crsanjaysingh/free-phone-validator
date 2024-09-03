<?php
namespace App\Services;

class PhoneValidationService
{
    protected $apiKey;
    protected $baseUrl = 'https://www.ipqualityscore.com/api/json/phone';

    public function __construct()
    {
        $this->apiKey = config('services.ipqs.api_key');
    }

    public function validatePhone($phone, $countries = ['US', 'CA'])
    {
        $parameters = [
            'country' => $countries
        ];

        $formattedParameters = http_build_query($parameters);

        $url = sprintf(
            '%s/%s/%s?%s',
            $this->baseUrl,
            $this->apiKey,
            $phone,
            $formattedParameters
        );

        $timeout = 5;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);

        $json = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($json, true);

        return $result;
    }
}
