<?php

namespace Drupal\alma_calendar\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides an 'Today hours' Block for a specific library.
 *
 * @Block(
 *   id = "alma_today_hours_block",
 *   admin_label = @Translation("Alma library today's hours block"),
 *   category = @Translation("External integration"),
 * )
 */
class TodayHoursBlock extends BlockBase implements BlockPluginInterface {
/**
   * {@inheritdoc}
   */
  public function build() {
    $config = $this->getConfiguration();

    if (!empty($config['alma_today_hours_block'])) {
      $name = $config['alma_today_hours_block'];
    }

    // TODO: Fetch the Library open hours for today

    // TODO: Compare with now to figure out if we are open or not

    return [
      '#theme' => 'today_hours_display',
      '#is_open' => true,
      '#hours' => '7AM - 5PM'
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);

    $config = $this->getConfiguration();

    $form['alma_today_hours_block'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Library Code'),
      '#description' => $this->t('The Alma Library code for the library hours you want to display'),
      '#default_value' => isset($config['alma_today_hours_block']) ? $config['alma_today_hours_block'] : '',
    ];

    return $form;
  }

  public function blockSubmit($form, FormStateInterface $form_state) {
    parent::blockSubmit($form, $form_state);
    $values = $form_state->getValues();
    $this->configuration['alma_today_hours_block'] = $values['alma_today_hours_block'];
  }

}