<?php

namespace App\Library\Coordinates;

use App\Interfaces\ICoordinates;
use Exception;
use Illuminate\Support\Facades\Http;


/**
 * Utilizes the Open Cage API to fetch the Latitude and Longitude for our addresses.
 */
class OpenCageGeocoding implements ICoordinates
{
    protected $apiKey;

    protected $latitude = '';

    protected $longitude = '';

    public function __construct()
    {
        $this->apiKey = env("OPENCAGEGEOCODINGAPI");

        if (empty($this->apiKey)) {
            throw new Exception("OpenCageGeocoding requires an API Key in the Env. `OPENCAGEGEOCODINGAPI`");
        }
    }

    public function fetchLatitude(string $address): string
    {
        if (empty($this->latitude)) {
            $this->loadCoordinates($address);
        }
        return $this->latitude;
    }

    public function fetchLongitude(string $address): string
    {
        if (empty($this->longitude)) {
            $this->loadCoordinates($address);
        }
        return $this->longitude;
    }

    protected function fetchCoordiantes(string $address)
    {
        $response = Http::get("https://api.opencagedata.com/geocode/v1/json?limit=1&q=" . $address . "&key=" . $this->apiKey);

        if ($response->getStatusCode() !== 200) {
            throw new Exception("OpenCageGeocoding failed to fetch the coordinates.");
        }
        return $response->json();
    }

    protected function loadCoordinates($address)
    {

        $json = $this->fetchCoordiantes($address);
        $result = $json['results'][0] ?? [];
        $this->longitude = $result['geometry']['lng'] ?? '';
        $this->latitude = $result['geometry']['lat'] ?? '';
    }
}
