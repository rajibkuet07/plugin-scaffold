<?php

namespace Plugin\Scaffold\Frontend;

/**
 * Shortcode handler class
 */
class Shortcode {
	/**
	 * Constructor of Shortcode class
	 */
  public function __construct() {
    add_shortcode( 'shortcode_tag', [ $this, 'render_shortcode' ] );
  }

  /**
   * Shortccode render function
   *
   * @param array $atts
   * @param string $content
   * 
   * @return string
   */
  public function render_shortcode( $atts, $content ) {
    return 'Hello from shortcode.';
  }
}
