<?php

namespace Drupal\ucr_global\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Provides a 'Organization name' block.
 *
 * @Block(
 *   id = "ucr_global_organization_name",
 *   admin_label = @Translation("Organization name")
 * )
 */
class UcrGlobalOrganizationNameBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = \Drupal::config('ucr_global.settings');
    $organization_name = $config->get('organization_name');
    $host = \Drupal::request()->getSchemeAndHttpHost();
    $url = Url::fromUri($host);
    $link = Link::fromTextAndUrl(t('@organization', array('@organization' => $organization_name)), $url )->toString();

    return array(
      '#type' => 'markup',
      '#markup' => $link,
    );
  }

}
