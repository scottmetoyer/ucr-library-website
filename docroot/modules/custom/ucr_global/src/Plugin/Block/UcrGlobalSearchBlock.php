<?php

namespace Drupal\ucr_global\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'UC Riverside search' block.
 *
 * @Block(
 *   id = "ucr_global_search",
 *   admin_label = @Translation("UC Riverside search")
 * )
 */
class UcrGlobalSearchBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    // @todo move the HTML into a Twig template.
    $output = <<< EOF
<div class="column shrink">
  <section class="google-search" role="search">
    <form id="masthead-search" action="https://www.ucr.edu/search.php" _lpchecked="1">
      <label class="show-for-sr" for="header-search">Search for:</label>
      <input type="text" maxlength="255" id="header-search" name="q" value="" placeholder=" ">
    </form>
  </section>
</div>
EOF;

    return array(
      '#type' => 'markup',
      '#markup' => $output,
      '#allowed_tags' => ['div', 'section', 'form', 'label', 'input'],
    );
  }

}
