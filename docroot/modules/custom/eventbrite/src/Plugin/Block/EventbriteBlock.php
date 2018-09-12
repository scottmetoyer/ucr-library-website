<?php

namespace Drupal\eventbrite\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides an 'Eventbrite' Block.
 *
 * @Block(
 *   id = "eventbrite_block",
 *   admin_label = @Translation("Eventbrite block"),
 *   category = @Translation("External integration"),
 * )
 */
class EventbriteBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    return array(
      '#markup' => $this->t('Hello, World!'),
    );
  }

}