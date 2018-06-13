<?php

namespace Drupal\ucr_global\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Department contact information' block.
 *
 * @Block(
 *     id = "ucr_global_footer_dept_info",
 *     admin_label = @Translation("UC Riverside Footer Dept Information Block")
 * )
 */
/* implement theme hook override of theme block with module template */
class UcrGlobalFooterDeptInfoBlock extends BlockBase {
    /* (function build builds an array) */
    public function build() {
        /* get variables from the config form */
        $config = \Drupal::config('ucr_global.settings');
        // define the variable keys
        $dept_name = $config->get('dept_name');
        $address_1 = $config->get('dept_address_1');
        $address_2 = $config->get('dept_address_2');
        $address_3 = $config->get('dept_address_3');
        $primary_email = $config->get('dept_primary_email');
        $alternate_email = $config->get('dept_alternate_email');
        $primary_phone = $config->get('dept_phone_1');
        $alternate_phone = $config->get('dept_phone_2');
        $fax = $config->get('dept_phone_3');
        $campusmap_url = $config->get('dept_map_url');
        $show_map = $config->get('show_campus_map');

        /* associate the keys (defined above) with a value (other than the default value, passed from .module)  */
        $build = [];
        $build['#theme'] = 'ucr_global_footer_dept_info_block';
        $build['#dept_name'] = $dept_name;
        $build['#address_1'] = $address_1;
        $build['#address_2'] = $address_2;
        $build['#address_3'] = $address_3;
        $build['#primary_email'] = $primary_email;
        $build['#alternate_email'] = $alternate_email;
        $build['#primary_phone'] = $primary_phone;
        $build['#alternate_phone'] = $alternate_phone;
        $build['#fax'] = $fax;
        $build['#campus_map'] = $campusmap_url;
        $build['#show_campus_map'] = $show_map;

        return $build;
    }
}
