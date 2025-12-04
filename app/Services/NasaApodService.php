<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class NasaApodService
{
    protected $cacheKey = 'nasa_apod_image';
    protected $cacheDuration; // in seconds
    protected $apiKey = 'jQbfVTKdFrTrzGqR6BDpbuaezyOXOlhtEM6HVVxU';

    public function __construct()
    {
        $this->cacheDuration = config('nasa.cache_duration', 3600); // 1 hour default
    }

    public function getImageUrl()
    {
        return Cache::remember($this->cacheKey, $this->cacheDuration, function () {
            try {
                $response = file_get_contents('https://api.nasa.gov/planetary/apod?api_key=' . $this->apiKey);
                $data = json_decode($response, true);
                if (isset($data['url'])) {
                    return $data['url'];
                }
            } catch (\Exception $e) {
                // Optionally log error
                return null;
            }
            return null;
        });
    }
}
