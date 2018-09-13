<?php

namespace Drupal\Eventbrite\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Defines EventbriteController class.
 */
class EventbriteController extends ControllerBase
{
    private function getEvents()
    {
        $json;
        $config = $this->config('eventbrite.settings');
        $eventbriteToken = $config->get('oauth_token');
        $organizationId = $config->get('organization_id');

        try {
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
        } catch (\Exception $e) {
            $json = "{ 'error' : 'Error connecting to Eventbrite.' }";
            \Drupal::logger('eventbrite')->error($e->getMessage());
        }

        return $json;
    }

    /**
     * {@inheritdoc}
     */
    public function content()
    {
        $content = $this->getEvents();

        return [
            '#theme' => 'events_list_display',
            '#events' => json_decode($content),
        ];
    }

}
