<?php

namespace Drupal\alma_calendar\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Defines AlmaCalendarController class.
 */
class AlmaCalendarController extends ControllerBase
{
    private function getAllHours()
    {
        /*
        $json;
        $config = $this->config('eventbrite.settings');
        $eventbriteToken = $config->get('oauth_token');
        $organizationId = $config->get('organization_id');
        
        try {
            // Do we have a valid response in the cache? If so, use it. Otherwise, make the web request.
            $cache = \Drupal::cache()->get('eventbrite_request');

            if ($cache) {
                $json = $cache->data;
            } else {
                $url = 'https://www.eventbriteapi.com/v3/organizations/' . $organizationId . '/events/?order_by=start_asc&status=live&show_series_parent=true&token=' . $eventbriteToken;
                $method = 'GET';
                $options = [
                    'form_params' => [
                    ],
                ];

                $client = \Drupal::httpClient();

                $response = $client->request($method, $url, $options);
                $code = $response->getStatusCode();
                if ($code == 200) {
                    $json = $response->getBody()->getContents();
                }
                
                // Save the response into the cache with a 1 minute expiration
                \Drupal::cache()->set('eventbrite_request', $json, strtotime("+1 minutes"));
            }
        } catch (\Exception $e) {
            $json = "{ 'error' : 'Error connecting to Eventbrite.' }";
            \Drupal::logger('eventbrite')->error($e->getMessage());
        }

        return $json;
        */
    }

    /**
     * {@inheritdoc}
     */
    public function content()
    {
        $content = $this->getAllHours();

        return [
            '#theme' => 'all_hours_display',
            '#hours' => json_decode($content),
        ];
    }

}
