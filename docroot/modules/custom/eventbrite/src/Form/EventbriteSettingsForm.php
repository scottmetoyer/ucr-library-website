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

        $form['example_thing'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Things'),
            '#default_value' => $config->get('example_thing'),
        );

        $form['other_things'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Other things'),
            '#default_value' => $config->get('other_things'),
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
        $config->set('example_thing', $form_state->getValue('example_thing'));

        // You can set multiple configurations at once by making
        // multiple calls to set()
        $config->set('other_things', $form_state->getValue('other_things'));
        $config->save();

        parent::submitForm($form, $form_state);
    }
}
