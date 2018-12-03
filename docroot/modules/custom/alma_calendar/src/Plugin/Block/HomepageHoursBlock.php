<?php

namespace Drupal\alma_calendar\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;

/**
 * Provides a 'Library hours' Block for the site homepage.
 *
 * @Block(
 *   id = "alma_homepage_hours_block",
 *   admin_label = @Translation("Alma library homepage hours block"),
 *   category = @Translation("External integration"),
 * )
 */
class HomepageHoursBlock extends BlockBase implements BlockPluginInterface
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
        return [
            '#theme' => 'homepage_hours_display',
        ];
    }
}
