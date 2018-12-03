<?php

namespace Drupal\alma_calendar\Plugin\Block;

use Drupal\alma_calendar\AlmaCalendarApi;
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
class TodayHoursBlock extends BlockBase implements BlockPluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getCacheMaxAge()
    {
        return 0;
    }

    /**
     * {@inheritdoc}
     */
    public function build()
    {
        $globalConfig = \Drupal::config('alma_calendar.settings');
        $apiKey = $globalConfig->get('api_key');

        $config = $this->getConfiguration();

        if (!empty($config['library_code'])) {
            $libraryCode = $config['library_code'];
        }

        $api = new AlmaCalendarApi(
            $apiKey,
            \Drupal::cache(),
            \Drupal::httpClient()
        );

        // Fetch the Library open hours for today
        try {
            $hours = simplexml_load_string($api->getTodayHours($libraryCode));
            $isOpen = false;
            $hourString = 'CLOSED';

            // Compare with now to figure out if we are open or not and build the output string
            if ($hours->day->hours->hour) {
                $open = strtotime($hours->day->hours->hour->from);
                $close = strtotime($hours->day->hours->hour->to);
                $now = time();

                if ($now > $open && $now < $close) {
                    $hourString = date('g:ia', $open) . ' - ' . date('g:ia', $close);
                    $isOpen = true;
                } else {
                    $hourString = $hourString . ' - open at ' . date('ga', $open);
                }
            }
        } catch (\Exception $e) {
            \Drupal::logger('alma')->error($e->getMessage());
        }

        return [
            '#theme' => 'today_hours_display',
            '#is_open' => $isOpen,
            '#hours' => $hourString,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function blockForm($form, FormStateInterface $form_state)
    {
        $form = parent::blockForm($form, $form_state);

        $config = $this->getConfiguration();

        $form['library_code'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Library Code'),
            '#description' => $this->t('The Alma Library code for the library hours you want to display'),
            '#default_value' => isset($config['alma_today_hours_block']) ? $config['alma_today_hours_block'] : '',
        ];

        return $form;
    }

    public function blockSubmit($form, FormStateInterface $form_state)
    {
        parent::blockSubmit($form, $form_state);
        $values = $form_state->getValues();
        $this->configuration['alma_today_hours_block'] = $values['alma_today_hours_block'];
    }
}
