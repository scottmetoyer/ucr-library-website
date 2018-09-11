<?php

namespace Drupal\Eventbrite\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Defines EventbriteController class.
 */
class EventbriteController extends ControllerBase
{

    /**
     * Display the markup.
     *
     * @return array
     *   Return markup array.
     */
    public function content()
    {
        return [
            '#type' => 'markup',
            '#markup' => $this->t('Hello, World!'),
        ];
    }

}
