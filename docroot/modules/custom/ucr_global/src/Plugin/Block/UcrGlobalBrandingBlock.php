<?php

namespace Drupal\ucr_global\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'UC Riverside Branding' block.
 *
 * @Block(
 *   id = "ucr_global_footer_branding",
 *   admin_label = @Translation("UC Riverside Branding")
 * )
 */
class UcrGlobalBrandingBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $output = <<< EOF
<p>
  <span class="footer-logo">
    <span class="show-for-sr">University of California, Riverside</span>
  </span>
  <br>
  900 University Ave.<br>
  Riverside, CA 92521
</p>
<p class="half-space">Tel: (951) 827-1012</p>
<ul class="footer_links footer-links">
  <li><a href="http://library.ucr.edu/" onclick="javascript:ga('send','event','Footer','Link','http%3A%2F%2Flibrary.ucr.edu%2F');">UCR Library</a></li>
  <li><a href="http://campusstatus.ucr.edu/" onclick="javascript:ga('send','event','Footer','Link','http%3A%2F%2Fcampusstatus.ucr.edu%2F');">Campus Status</a></li>
  <li><a href="http://campusstore.ucr.edu/" onclick="javascript:ga('send','event','Footer','Link','http%3A%2F%2Fcampusstore.ucr.edu%2F');">Campus Store</a></li>
  <li><a href="http://www.ucr.edu/employment.html" onclick="javascript:ga('send','event','Footer','Link','http%3A%2F%2Fwww.ucr.edu%2Femployment.html');">Career Opportunities</a></li>
  <li><a href="http://diversity.ucr.edu/" onclick="javascript:ga('send','event','Footer','Link','http%3A%2F%2Fdiversity.ucr.edu%2F');">Diversity</a></li>
  <li><a href="http://www.ucr.edu/about/directions.html" onclick="javascript:ga('send','event','Footer','Link','http%3A%2F%2Fwww.ucr.edu%2Fabout%2Fdirections.html');">Maps and Directions</a></li>
  <li><a href="http://tours.ucr.edu/" onclick="javascript:ga('send','event','Footer','Link','http%3A%2F%2Ftours.ucr.edu%2F');">Visit UCR</a></li>
</ul>
EOF;

    return array(
      '#type' => 'markup',
      '#markup' => $output,
    );
  }

}
