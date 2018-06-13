<?php

namespace Drupal\ucr_global\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'UC Riverside wide search' block.
 *
 * @Block(
 *   id = "ucr_global_wide_search",
 *   admin_label = @Translation("UC Riverside wide search")
 * )
 */
class UcrGlobalWideSearchBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    // @todo move the HTML into a Twig template.
    $output = <<< EOF
<div class="row-footer-search row align-center">
  <div class="small-12 medium-8 large-6 column">
    <section class="footer-widget google-search">
      <form action="https://www.ucr.edu/search.php">
        <label class="show-for-sr" for="footer-search">Search for:</label>
        <input type="text" maxlength="255" id="footer-search" name="q" value="" placeholder=" " />
      </form>
    </section>
  </div>
</div>
EOF;

    return array(
      '#type' => 'markup',
      '#markup' => $output,
      '#allowed_tags' => ['div', 'section', 'form', 'label', 'input'],
    );
  }

}
