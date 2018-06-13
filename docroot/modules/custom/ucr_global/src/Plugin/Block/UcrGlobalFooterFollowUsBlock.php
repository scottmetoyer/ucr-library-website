<?php

namespace Drupal\ucr_global\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Provides a 'Follow Us' block.
 *
 * @Block(
 *   id = "ucr_global_footer_follow_us",
 *   admin_label = @Translation("UC Riverside Footer Follow Us Links Block")
 * )
*/

class UcrGlobalFooterFollowUsBlock extends BlockBase {
	public function build() {
		$config = \Drupal::config( 'ucr_global.settings' );
		
		$social_types = array('facebook' =>
                                  array('url' => '',
                                        'css' => 'button mdi mdi-facebook',
                                        'title' => ''
                                  ),
                              'twitter' =>
                                  array('url' => '',
                                        'css' => 'button mdi mdi-twitter',
                                        'title' => ''
                                  ),
                              'youtube' =>
                                  array('url' => '',
                                        'css' => 'button mdi mdi-youtube-play',
                                        'title' => ''
                                  ),
                              'instagram' =>
                                  array('url' => '',
                                        'css' => 'button mdi mdi-instagram',
                                        'title' => ''
                                  ),
                              'linkedin' =>
                                  array('url' => '',
                                        'css' => 'button mdi mdi-linkedin',
                                        'title' => ''
                                  ),
                              'flickr' =>
                                  array('url' => '',
                                        'css' => 'button mdi mdi-camera-iris',
                                        'title' => ''
                                  ),
                              'rss' =>
                                  array('url' => '',
                                        'css' => 'button mdi mdi-rss',
                                        'title' => ''
                                  )
        );

		$social_data = array();

		foreach($social_types as $st_key => $st_array) {
			$social_config = $config->get($st_key."_url");
			
			if(!empty($social_config)) {
			    $social_data[$st_key] = $st_array;
			    $social_data[$st_key]['url'] = $social_config;
			    $social_data[$st_key]['title'] = $config->get($st_key."_title");
			}
		}

		$build[ '#theme' ] = 'ucr_global_footer_follow_us_block';
		$build[ '#social_links' ] = $social_data;

		return $build;
	}

}