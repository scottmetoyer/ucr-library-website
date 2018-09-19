<?php

namespace Drupal\alma_calendar\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure Alma Calendar settings for this site.
 */
class AlmaCalendarSettingsForm extends ConfigFormBase
{
    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'alma_calendar_admin_settings';
    }

    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames()
    {
        return [
            'alma_calendar.settings',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $config = $this->config('alma_calendar.settings');

        $form['api_key'] = array(
            '#type' => 'textfield',
            '#title' => t('Alma API Key'),
            '#default_value' => $config->get('api_key'),
            '#description' => t('The Alma Application referenced by this API key must have Configuration endpoint permissions'),

        );

        return parent::buildForm($form, $form_state);
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $config = $this->config('alma_calendar.settings');

        // Set the submitted configuration setting
        $config->set('api_key', $form_state->getValue('api_key'));
        $config->save();

        parent::submitForm($form, $form_state);
    }
}
