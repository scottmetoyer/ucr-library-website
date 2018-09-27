<?php

namespace Drupal\eventbrite\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides an 'Eventbrite Carousel' Block.
 *
 * @Block(
 *   id = "eventbrite_carousel_block",
 *   admin_label = @Translation("Eventbrite carousel block"),
 *   category = @Translation("External integration"),
 * )
 */
class EventbriteCarouselBlock extends BlockBase implements BlockPluginInterface
{
    private function getEvents()
    {
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

                // Save the response into the cache with a 1 hour expiration
                \Drupal::cache()->set('eventbrite_request', $json, strtotime("+60 minutes"));
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
    public function getCacheMaxAge()
    {
        return 0;
    }

    /**
     * {@inheritdoc}
     */
    public function build()
    {
        $config = $this->getConfiguration();

        if (!empty($config['library_code'])) {
            $libraryCode = $config['library_code'];
        }

        $content = $this->getEvents();

        return [
            '#theme' => 'events_carousel_display',
            '#events' => json_decode($content),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function blockForm($form, FormStateInterface $form_state)
    {
        $form = parent::blockForm($form, $form_state);

        $config = $this->getConfiguration();

        $form['library_code'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Library Code'),
            '#description' => $this->t('The Alma Library code for the library hours you want to display'),
            '#default_value' => isset($config['alma_today_hours_block']) ? $config['alma_today_hours_block'] : '',
        ];

        return $form;
    }

    public function blockSubmit($form, FormStateInterface $form_state)
    {
        parent::blockSubmit($form, $form_state);
        $values = $form_state->getValues();
        $this->configuration['alma_today_hours_block'] = $values['alma_today_hours_block'];
    }
}
