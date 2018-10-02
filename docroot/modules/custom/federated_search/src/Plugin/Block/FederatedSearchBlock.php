<?php

namespace Drupal\federated_search\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides an federated search widget
 *
 * @Block(
 *   id = "federated_search_block",
 *   admin_label = @Translation("Federated search block"),
 *   category = @Translation("External integration"),
 * )
 */
class FederatedSearchBlock extends BlockBase implements BlockPluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function build()
    {
        return [
            '#theme' => 'search_block_display'
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function blockForm($form, FormStateInterface $form_state)
    {
        $form = parent::blockForm($form, $form_state);
        return $form;
    }

    public function blockSubmit($form, FormStateInterface $form_state)
    {
        parent::blockSubmit($form, $form_state);
    }
}
