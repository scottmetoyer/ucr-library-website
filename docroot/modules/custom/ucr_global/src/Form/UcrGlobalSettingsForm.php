<?php

namespace Drupal\ucr_global\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Implements a form to collect security check configuration.
 */
class UcrGlobalSettingsForm extends ConfigFormBase {
  /**
   * {@inheritdoc}.
   */
  public function getFormId() {
    return 'ucr_global_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['ucr_global.settings'];
  }

  /**
   * {@inheritdoc}.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $module_path = drupal_get_path('module', 'ucr_global');

    $config = \Drupal::config('ucr_global.settings');

    $form['ucr_global_description'] = array(
      '#markup' => t('This module defines global blocks for UC Riverside sites.'),
    );

    $form['organization_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Organization name'),
      '#description' => $this->t('The parent name that should be displayed in the top-left corner of the site.'),
      '#required' => TRUE,
      '#default_value' => $config->get('organization_name'),
    ];

    $form['audience_links_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Audience links menu text'),
      '#description' => $this->t('The text that should be displayed before a user clicks the audience links menu.'),
      '#default_value' => $config->get('audience_links_text'),
    ];

    $form['dept_contact_info'] = array(
        '#type' => 'fieldset',
        '#title' => $this->t('Dept Contact Info'),
    );

      $form['dept_contact_info']['dept_name'] = array(
          '#type' => 'textfield',
          '#title' => $this->t('Dept Name'),
          '#description' => $this->t('Your Dept. Name.'),
          '#required' => true,
          '#default_value' => $config->get('dept_name')
      );

      $form['dept_contact_info']['dept_address_1'] = array(
          '#type' => 'textfield',
          '#title' => $this->t('Address Line 1'),
          '#required' => true,
          '#default_value' => $config->get('dept_address_1')
      );

      $form['dept_contact_info']['dept_address_2'] = array(
          '#type' => 'textfield',
          '#title' => $this->t('&nbsp;'),
          '#default_value' => $config->get('dept_address_2')
      );

      $form['dept_contact_info']['dept_address_3'] = array(
          '#type' => 'textfield',
          '#title' => $this->t('City, State, &amp; Zipcode'),
          '#required' => true,
          '#default_value' => $config->get('dept_address_3')
      );

      $form['dept_contact_info']['dept_contact_email'] = array(
          '#type' => 'email',
          '#title' => $this->t('Contact Email'),
          '#required' => true,
          '#default_value' => $config->get('dept_contact_email')
      );

      $form['dept_contact_info']['dept_contact_phone_1'] = array(
          '#type' => 'tel',
          '#title' => $this->t('Primary Phone Number'),
          '#required' => true,
          '#default_value' => $config->get('dept_contact_phone_1')
      );

      $form['dept_contact_info']['dept_contact_phone_2'] = array(
          '#type' => 'tel',
          '#title' => $this->t('Alt. Phone / Fax Number'),
          '#default_value' => $config->get('dept_contact_phone_2')
      );

      $form['follow_us'] = [
    	'#type' => 'fieldset',
    	'#title' => $this->t('Follow Us'),
    	'#description' => $this->t('This is the configuration group for the \'Follow Us\' block.'),
      '#required' => FALSE,
      '#default_value' => $config->get('follow_us'),
      ];

        $form['follow_us']['facebook'] = [
    		'#type' => 'textfield',
    		'#title' => $this->t('Facebook'),
    		'#description' => $this->t('This is the configuration for the \'Facebook\' block.'),
    		'#required' => TRUE,
    		'#default_value' => $config->get('facebook'),
      	];

        $form['follow_us']['twitter'] = [
    		'#type' => 'textfield',
    		'#title' => $this->t('Twitter'),
    		'#description' => $this->t('This is the configuration for the \'Twitter\' block.'),
    		'#required' => TRUE,
    		'#default_value' => $config->get('twitter'),
      	];

        $form['follow_us']['youtube'] = [
    		'#type' => 'textfield',
    		'#title' => $this->t('YouTube'),
    		'#description' => $this->t('This is the configuration for the \'YouTube\' block.'),
    		'#required' => TRUE,
    		'#default_value' => $config->get('youtube'),
      	];

        $form['follow_us']['linkedin'] = [
    		'#type' => 'textfield',
    		'#title' => $this->t('LinkedIn'),
    		'#description' => $this->t('This is the configuration for the \'LinkedIn\' block.'),
    		'#required' => TRUE,
    		'#default_value' => $config->get('linkedin'),
      	];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // @TODO
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $list = [];
    $this->buildAttributeList($list, $form_state->getValues());
    $config = $this->config('ucr_global.settings');

    foreach ($list as $key => $value) {
      $config->set($key, $value);
    }

    $config->save();

    parent::submitForm($form, $form_state);
  }

  /**
   * Build the configuration form value list.
   */
  protected function buildAttributeList(
    array &$list = [],
    array $rawAttributes = [],
    $currentName = '')
  {
    foreach ($rawAttributes as $key => $rawAttribute) {
      $name = $currentName ? $currentName . '.' . $key:$key;
      if (in_array($name,['op','form_id','form_token','form_build_id','submit'])){
        continue;
      }
      if (is_array($rawAttribute)) {
        $this->buildAttributeList($list, $rawAttribute, $name);
      } else {
        $list[$name] = $rawAttribute;
      }
    }
  }
}
