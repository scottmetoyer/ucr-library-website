<?php

namespace Drupal\eventbrite\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides an 'Eventbrite List' Block.
 *
 * @Block(
 *   id = "eventbrite_list_block",
 *   admin_label = @Translation("Eventbrite event list block"),
 *   category = @Translation("External integration"),
 * )
 */
class EventbriteListBlock extends BlockBase implements BlockPluginInterface {

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

    $form['eventbrite_block_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Who'),
      '#description' => $this->t('Who do you want to say hello to?'),
      '#default_value' => isset($config['eventbrite_block_name']) ? $config['eventbrite_block_name'] : '',
    ];

    return $form;
  }

}