<?php

namespace Drupal\ucr_global\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Provides a 'Follow Us' block.
 *
 * @Block(
 *   id = "ucr_global_follow_us",
 *   admin_label = @Translation("Follow us")
 * )
 */

class UcrGlobalFollowUsBlock extends BlockBase {
  public function build() {
    $config = \Drupal::config('ucr_global.settings');
    $social = array(
      'facebook' => $config->get('facebook'),
      'twitter' => $config->get('twitter'),
      'youtube' => $config->get('youtube'),
      'linkedin' => $config->get('linkedin'),
    );

    $output = array();
    foreach ($social as $network => $link) {
      $url = Url::fromUri($link);
      $link_options = array(
        'attributes' => array(
          'class' => array(
            'button',
            'button-' . $network,
          ),
        ),
      );
      $url->setOptions($link_options);
      // @todo remove the awkward <span>.
      $output[$network] = Link::fromTextAndUrl(t('<span class="show-for-sr">Follow us on @network</span>', array('@network' => $network)), $url )->toString();
    }
    $links = '<div class="button-group">' . implode("",$output) . '</div>';

    return array(
      '#type' => 'markup',
      // The list itself.
      '#markup' => $links,
    );
  }

}
