<?php

namespace Drupal\alma_calendar\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides an 'Library Calendar open hours' Block for a specific library.
 *
 * @Block(
 *   id = "alma_library_calendar_block",
 *   admin_label = @Translation("Alma library calendar open hours block"),
 *   category = @Translation("External integration"),
 * )
 */
class LibraryCalendarBlock extends BlockBase implements BlockPluginInterface {

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

    $form['alma_library_calendar_block'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Library Code'),
      '#description' => $this->t('The Alma Library code for the library hours you want to display'),
      '#default_value' => isset($config['alma_library_calendar_block']) ? $config['alma_library_calendar_block'] : '',
    ];

    return $form;
  }

  public function blockSubmit($form, FormStateInterface $form_state) {
    parent::blockSubmit($form, $form_state);
    $values = $form_state->getValues();
    $this->configuration['alma_library_calendar_block'] = $values['alma_library_calendar_block'];
  }

}