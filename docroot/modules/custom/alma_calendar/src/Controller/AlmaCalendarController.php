<?php

namespace Drupal\alma_calendar\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Defines AlmaCalendarController class.
 */
class AlmaCalendarController extends ControllerBase
{
    private function getLibraryHours($libraryCode) {
        $xml;
        $cacheName = 'alma_library_hours_'.$libraryCode;
        $config = $this->config('alma_calendar.settings');
        $apiKey = $config->get('api_key');

        try {
            // Do we have a valid response in the cache? If so, use it. Otherwise, make the web request.
            $cache = \Drupal::cache()->get($cacheName);

            if ($cache) {
                $xml = $cache->data;
            } else {
                $httpClient = \Drupal::httpClient();
                $url = 'https://api-na.hosted.exlibrisgroup.com/almaws/v1/conf/libraries/'.$libraryCode.'/open-hours?apiKey=' . $apiKey;
                $response = $httpClient->request('GET', $url, []);
                $code = $response->getStatusCode();
                if ($code == 200) {
                    $xml = $response->getBody()->getContents();
                }

                // Save the response into the cache with a 1 hour expiration
                \Drupal::cache()->set($cacheName, $xml, strtotime("+60 minutes"));
            }
        } catch (\Exception $e) {
            $xml = "<error>'Error connecting to Alma.</error>";
            \Drupal::logger('alma')->error($e->getMessage());
        }

        return $xml;
    }

    /**
     * {@inheritdoc}
     */
    public function content()
    {
        // Fetch each libraries hours individually
        $orbachHours = $this->getLibraryHours('ORBACH');
        $scuaHours  = $this->getLibraryHours('SPECIALCOL');
        $musicHours  = $this->getLibraryHours('MUSIC');
        $riveraHours  = $this->getLibraryHours('RIVERA');

        return [
            '#theme' => 'all_hours_display',
            '#orbach' => simplexml_load_string($orbachHours),
            '#scua' => simplexml_load_string($scuaHours),
            '#music' => simplexml_load_string($musicHours),
            '#rivera' => simplexml_load_string($riveraHours)
        ];
    }

}
