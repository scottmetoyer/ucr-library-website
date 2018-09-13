<?php

namespace Drupal\eventbrite\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure Eventbrite settings for this site.
 */
class EventbriteSettingsForm extends ConfigFormBase
{
    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'eventbrite_admin_settings';
    }

    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames()
    {
        return [
            'eventbrite.settings',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $config = $this->config('eventbrite.settings');

        $form['oauth_token'] = array(
            '#type' => 'textfield',
            '#title' => t('Personal OAuth token'),
            '#default_value' => $config->get('oauth_token'),
        );

        $form['organization_id'] = array(
            '#type' => 'textfield',
            '#title' => t('Organization ID'),
            '#default_value' => $config->get('organization_id'),
            '#description' => t('This can be retrieved from the Eventbrite <a target="_blank" href="https://www.eventbriteapi.com/v3/users/me/organizations/?token='.$config->get('oauth_token').'">/users/me/organizations API endpoint</a>'),
        );

        return parent::buildForm($form, $form_state);
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $config = $this->config('eventbrite.settings');

        // Set the submitted configuration setting
        $config->set('oauth_token', $form_state->getValue('oauth_token'));
        $config->set('organization_id', $form_state->getValue('organization_id'));
        $config->save();

        parent::submitForm($form, $form_state);
    }
}
