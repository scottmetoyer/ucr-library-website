<?php

namespace Drupal\alma_calendar\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides an 'Alma Calendar open hours' Block.
 *
 * @Block(
 *   id = "alma_calendar_block",
 *   admin_label = @Translation("Alma calendar open hours block"),
 *   category = @Translation("External integration"),
 * )
 */
class AlmaCalendarBlock extends BlockBase implements BlockPluginInterface {

  /**
   * {@inheritdoc}
   */
  public function build() {
    return array(
      '#markup' => $this->t('Hello, World!'),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);

    $config = $this->getConfiguration();

    $form['alma_calendar_block_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Who'),
      '#description' => $this->t('Who do you want to say hello to?'),
      '#default_value' => isset($config['eventbrite_block_name']) ? $config['eventbrite_block_name'] : '',
    ];

    return $form;
  }

}