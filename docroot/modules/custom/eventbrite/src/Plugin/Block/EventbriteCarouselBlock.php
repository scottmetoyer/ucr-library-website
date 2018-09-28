<?php

namespace Drupal\eventbrite\Plugin\Block;

use Drupal\eventbrite\EventbriteApi;
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
      $api = new EventbriteApi();

      $config = \Drupal::config('eventbrite.settings');
      $eventbriteToken = $config->get('oauth_token');
      $organizationId = $config->get('organization_id');
      $content = $api->getEvents($eventbriteToken, $organizationId);

        return [
            '#theme' => 'events_carousel_display',
            '#events' => json_decode($content),
        ];
    }
}
