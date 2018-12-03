<?php

namespace Drupal\alma_calendar\Controller;

use Drupal\alma_calendar\AlmaCalendarApi;
use Drupal\Core\Controller\ControllerBase;

/**
 * Defines AlmaCalendarController class.
 */
class AlmaCalendarController extends ControllerBase
{
    /**
     * {@inheritdoc}
     */
    public function content()
    {
        $config = $this->config('alma_calendar.settings');
        $apiKey = $config->get('api_key');

        $api = new AlmaCalendarApi(
            $apiKey,
            \Drupal::cache(),
            \Drupal::httpClient()
        );

        // Fetch each libraries hours individually
        try {
            $orbachHours = $api->getLibraryHours('ORBACH');
            $scuaHours = $api->getLibraryHours('SPECIALCOL');
            $musicHours = $api->getLibraryHours('MUSIC');
            $riveraHours = $api->getLibraryHours('RIVERA');
        } catch (\Exception $e) {
            \Drupal::logger('alma')->error($e->getMessage());
        }
        
        return [
            '#theme' => 'all_hours_display',
            '#orbach' => simplexml_load_string($orbachHours),
            '#scua' => simplexml_load_string($scuaHours),
            '#music' => simplexml_load_string($musicHours),
            '#rivera' => simplexml_load_string($riveraHours),
        ];
    }

}
