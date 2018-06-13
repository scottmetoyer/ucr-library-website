<?php

namespace Drupal\ucr_global\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Provides a 'Default audience links' block.
 *
 * @Block(
 *   id = "ucr_global_default_audience_links",
 *   admin_label = @Translation("Default audience links")
 * )
 */
class UcrGlobalDefaultAudienceLinksBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    // @todo replace this with a pre-populated menu using the menu system.
    $output = <<< EOF
<button class="button button-information block-no-margin" type="button" data-toggle="audiences">Find Information for...</button>
<nav class="dropdown-pane dropdown-information" aria-label="Audience navigation" id="audiences" data-dropdown data-hover="true" data-hover-pane="true" data-hover-delay="0" data-v-offset="-1">
  <ul>
    <li><a href="/undergraduate.html">Students</a></li>
    <li><a href="nonexistent">Alumni</a></li>
    <li><a href="nonexistent">Parents</a></li>
    <li><a href="nonexistent">Community</a></li>
    <li><a href="nonexistent">Partners</a></li>
    <li><a href="nonexistent">Donors</a></li>
  </ul>
</nav>
EOF;

    return array(
      '#type' => 'markup',
      '#markup' => $output,
      '#allowed_tags' => ['button', 'nav', 'ul', 'li'],
    );
  }
}
