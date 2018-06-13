<?php

namespace Drupal\ucr_global\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'Department contact information' block.
 *
 * @Block(
 *     id = "ucr_global_dept_contact_info",
 *     admin_label = @Translation("Deptartment contact information")
 * )
 */

class UcrGlobalDeptContactBlock extends BlockBase {
    public function build() {
        $config = \Drupal::config('ucr_global.settings');

        $dept_name = $config->get('dept_name');
        $address_1 = $config->get('dept_address_1');
        $address_2 = $config->get('dept_address_2');
        $address_3 = $config->get('dept_address_3');
        $email = $config->get('dept_contact_email');
        $phone_1 = $config->get('dept_contact_phone_1');
        $phone_2 = $config->get('dept_contact_phone_2');

        $full_string = '<h1>' . $dept_name . '</h1><p>
<a href="http://campusmap.ucr.edu/?loc=ENGR2" title="Campus Map">' . $address_1 .
(!empty($address_2) ? '<br />' . $address_2 . '</a><br />' : '</a><br />') .
'<br />' . $address_3 . '<br />' . $email . '<br />' . $phone_1 .
(!empty($phone_2) ? '<br />' . $phone_2 : "") . '</p>';

        return array(
            '#type' => 'markup',
            '#markup' => $full_string,
        );
    }
}
