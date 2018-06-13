<?php

namespace Drupal\ucr_global\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Provides a 'Default related links' block.
 *
 * @Block(
 *   id = "ucr_global_default_related_links",
 *   admin_label = @Translation("Default related links")
 * )
 */
class UcrGlobalDefaultRelatedLinksBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    // @todo replace this with a pre-populated menu using the menu system.
    $output = <<< EOF
<h1>Related Links</h1>
<ul>
  <li><a href="https://www.engr.ucr.edu/cgi-bin/conf_rooms/public/display.cgi">BCOE Available Conference Rooms and Technology Resources</a></li>
  <li><a href="http://www.ucr.edu/research/licensing.html">License Bourns Technology</a></li>
  <li><a href="http://www.ucr.edu/giving/">Give to Bourns</a></li>
  <li><a href="http://www.engr.ucr.edu/intranet/">Intranet</a></li>
  <li><a href="http://www.engr.ucr.edu/inventthefuture.html">Invent the Future</a></li>
  <li><a href="http://systems.engr.ucr.edu">Systems</a></li>
</ul>
EOF;

    return array(
      '#type' => 'markup',
      '#markup' => $output,
      '#allowed_tags' => ['h1', 'ul', 'li'],
    );
  }
}
