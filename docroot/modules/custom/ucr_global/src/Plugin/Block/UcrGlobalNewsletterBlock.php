<?php

namespace Drupal\ucr_global\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'UC Riverside newsletter' block.
 *
 * @Block(
 *   id = "ucr_global_newsletter",
 *   admin_label = @Translation("UC Riverside newsletter")
 * )
 */
class UcrGlobalNewsletterBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $output = <<< EOF
<h1>Newsletter</h1>
<p>Sign up for our monthly newsletter.</p>
<form>
  <label class="show-for-sr" for="footer-newsletter">E-mail address:</label>
  <input type="text" id="footer-newsletter" />
</form>
EOF;

    return array(
      '#type' => 'markup',
      '#markup' => $output,
      '#allowed_tags' => ['h1', 'p', 'form', 'label', 'input'],
    );
  }

}
