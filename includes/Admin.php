<?php

namespace Plugin\Scaffold;

class Admin {
  /**
   * Constractor of the Admin class
   */
  public function __construct() {
		$plugin_pages = new Admin\Plugin_Menu_Pages();
    new Admin\Menu( $plugin_pages );
  }
}
