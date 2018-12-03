<?php

namespace Drupal\alma_calendar;

/**
 * Provides methods for calling Alma Calendar API endpoints
 *
 */
class AlmaCalendarApi
{
    private $apiKey;
    private $httpClient;
    private $drupalCache;

    public function __construct($apiKey, $drupalCache, $httpClient)
    {
        $this->apiKey = $apiKey;
        $this->drupalCache = $drupalCache;
        $this->httpClient = $httpClient;
    }

    // Gets all the hour entries for a single library
    public function getLibraryHours($libraryCode)
    {
        $xml;
        $cacheName = 'alma_library_hours_' . $libraryCode;

        // Do we have a valid response in the cache? If so, use it. Otherwise, make the web request.
        $cache = $this->drupalCache->get($cacheName);

        if ($cache) {
            $xml = $cache->data;
        } else {
            $url = 'https://api-na.hosted.exlibrisgroup.com/almaws/v1/conf/libraries/' . $libraryCode . '/open-hours?apiKey=' . $this->apiKey;
            $response = $this->httpClient->request('GET', $url, []);
            $code = $response->getStatusCode();
            if ($code == 200) {
                $xml = $response->getBody()->getContents();
            }

            // Save the response into the cache with a 1 hour expiration
            $this->drupalCache->set($cacheName, $xml, strtotime("+60 minutes"));
        }

        return $xml;
    }

    // Gets today's hour entry for a single library
    public function getTodayHours($libraryCode)
    {
        $xml;
        $cacheName = 'alma_today_library_hours_' . $libraryCode;

        // Do we have a valid response in the cache? If so, use it. Otherwise, make the web request.
        $cache = $this->drupalCache->get($cacheName);

        if ($cache) {
            $xml = $cache->data;
        } else {
            $url = 'https://api-na.hosted.exlibrisgroup.com/almaws/v1/conf/libraries/' . $libraryCode . '/open-hours?apiKey=' . $this->apiKey . '&from='
            . date('Y-m-d') . '&to=' . date('Y-m-d');

            $response = $this->httpClient->request('GET', $url, []);
            $code = $response->getStatusCode();
            if ($code == 200) {
                $xml = $response->getBody()->getContents();
            }

            // Save the response into the cache with a 10 minute expiration
            $this->drupalCache->set($cacheName, $xml, strtotime("+10 minutes"));
        }

        return $xml;
    }

}
