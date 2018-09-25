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
class TodayHoursBlock extends BlockBase implements BlockPluginInterface
{
    private function getTodayHours($libraryCode)
    {
        $xml;
        $cacheName = 'alma_today_library_hours_' . $libraryCode;
        $config = \Drupal::config('alma_calendar.settings');
        $apiKey = $config->get('api_key');

        try {
            // Do we have a valid response in the cache? If so, use it. Otherwise, make the web request.
            $cache = \Drupal::cache()->get($cacheName);

            if ($cache) {
                $xml = $cache->data;
            } else {
                $httpClient = \Drupal::httpClient();
                $url = 'https://api-na.hosted.exlibrisgroup.com/almaws/v1/conf/libraries/' . $libraryCode . '/open-hours?apiKey=' . $apiKey . '&from='
                . date('Y-m-d') . '&to=' . date('Y-m-d');

                $response = $httpClient->request('GET', $url, []);
                $code = $response->getStatusCode();
                if ($code == 200) {
                    $xml = $response->getBody()->getContents();
                }

                // Save the response into the cache with a 1 hour expiration
                \Drupal::cache()->set($cacheName, $xml, strtotime("+1 minutes"));
            }
        } catch (\Exception $e) {
            $xml = "<error>'Error connecting to Alma.</error>";
            \Drupal::logger('alma')->error($e->getMessage());
        }

        return $xml;
    }

    /**
     * {@inheritdoc}
     */
    public function build()
    {
        $config = $this->getConfiguration();

        if (!empty($config['library_code'])) {
            $libraryCode = $config['library_code'];
        }

        // Fetch the Library open hours for today
        $hours = simplexml_load_string($this->getTodayHours($libraryCode));
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
