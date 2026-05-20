<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Setting;
use Exception;
use Illuminate\Support\Facades\Cache;

class FedExService
{
    protected $apiUrl;
    protected $apiKey;
    protected $secretKey;
    protected $originZip;

    public function __construct()
    {
        $mode = Setting::get('fedex_mode', 'sandbox');
        $this->apiUrl = $mode === 'live' ? 'https://apis.fedex.com' : 'https://apis-sandbox.fedex.com';
        $this->apiKey = Setting::get('fedex_api_key');
        $this->secretKey = Setting::get('fedex_secret_key');
        $this->originZip = Setting::get('fedex_origin_zip');
    }

    public function isConfigured()
    {
        return !empty($this->apiKey) && !empty($this->secretKey) && !empty($this->originZip);
    }

    public function getAuthToken()
    {
        $cacheKey = 'fedex_auth_token';

        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        $response = Http::asForm()->post("{$this->apiUrl}/oauth/token", [
            'grant_type' => 'client_credentials',
            'client_id' => $this->apiKey,
            'client_secret' => $this->secretKey,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $token = $data['access_token'];
            Cache::put($cacheKey, $token, 3500);
            return $token;
        }

        throw new Exception('Failed to authenticate with FedEx API.');
    }

    public function getRates($destinationZip, $totalWeightLbs)
    {
        if (!$this->isConfigured()) {
            return ['error' => 'FedEx is not fully configured in settings.'];
        }

        if ($totalWeightLbs <= 0) {
            $totalWeightLbs = 1; // Default to 1 lb
        }

        try {
            $token = $this->getAuthToken();
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
        ])->post("{$this->apiUrl}/rate/v1/rates/quotes", [
            'accountNumber' => [
                'value' => '000000000' // Placeholder if required. 
            ],
            'requestedShipment' => [
                'shipper' => [
                    'address' => [
                        'postalCode' => $this->originZip,
                        'countryCode' => 'US'
                    ]
                ],
                'recipient' => [
                    'address' => [
                        'postalCode' => $destinationZip,
                        'countryCode' => 'US'
                    ]
                ],
                'pickupType' => 'DROPOFF_AT_FEDEX_LOCATION',
                'rateRequestType' => [
                    'LIST'
                ],
                'requestedPackageLineItems' => [
                    [
                        'weight' => [
                            'units' => 'LB',
                            'value' => round($totalWeightLbs, 2)
                        ]
                    ]
                ]
            ]
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $rates = [];
            
            if (isset($data['output']['rateReplyDetails'])) {
                foreach ($data['output']['rateReplyDetails'] as $detail) {
                    $serviceName = $detail['serviceName'] ?? $detail['serviceType'];
                    // Find the net charge
                    $amount = 0;
                    if (isset($detail['ratedShipmentDetails'][0]['totalNetCharge'])) {
                        $amount = $detail['ratedShipmentDetails'][0]['totalNetCharge'];
                    }
                    if ($amount > 0) {
                        $rates[] = [
                            'service_name' => $serviceName,
                            'service_type' => $detail['serviceType'],
                            'amount' => $amount
                        ];
                    }
                }
            }
            
            if (empty($rates)) {
                return ['error' => 'No valid FedEx shipping rates returned for this zip code.'];
            }
            
            return ['success' => true, 'rates' => $rates];
        }

        $errorData = $response->json();
        $errorMsg = 'FedEx Error';
        if (isset($errorData['errors'][0]['message'])) {
            $errorMsg = $errorData['errors'][0]['message'];
        }
        
        return ['error' => $errorMsg];
    }
}
