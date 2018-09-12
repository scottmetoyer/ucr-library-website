<?php

namespace Drupal\Eventbrite\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Defines EventbriteController class.
 */
class EventbriteController extends ControllerBase
{

    /**
     * Display the markup.
     *
     * @return array
     *   Return markup array.
     */
    private function getEvents() {
        $body;
        $url = 'https://www.eventbriteapi.com/v3/users/me/?token=PVVY6TKJY7CRARG7NN7K';
        $method = 'GET';
        $options = [
        'form_params' => [
        ]
        ];
        
        $client = \Drupal::httpClient();
        
        $response = $client->request($method, $url, $options);
        $code = $response->getStatusCode();
        if ($code == 200) {
            $body = $response->getBody()->getContents();
        }

        return $body;
    }

    public function content()
    {
        $content = $this->getEvents();

        return [
            '#type' => 'markup',
            '#markup' => $this->t($this->getEvents()),
        ];
    }

}
