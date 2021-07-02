<?php

namespace Plugin\Scaffold\Admin;

/**
 * The menu handler class
 */
class Menu {
  /**
   * Constructor of Menu class
   */
  public function __construct() {
    add_action( 'admin_menu', [ $this, 'admin_menu' ] );
  }

  /**
   * Register menu pages
   *
   * @return void
   */
  public function admin_menu() {
		$parent_slug  = 'plugin-scaffold';
		$capability   = 'manage_options';

    add_menu_page( __( 'Plugin Scaffold', 'plugin-scaffold' ), __( 'Plugin Scaffold', 'plugin-scaffold' ), $capability, 'plugin-scaffold', [ $this, 'plugin_scaffold' ], 'dashicons-smiley', 81 );
    add_submenu_page( $parent_slug, __( 'Plugin Menu', 'plugin-scaffold' ), __( 'Plugin Menu', 'plugin-scaffold' ), $capability, $parent_slug, [ $this, 'plugin_scaffold' ] );
    add_submenu_page( $parent_slug, __( 'Settings', 'plugin-scaffold' ), __( 'Settings', 'plugin-scaffold' ), $capability, 'plugin-scaffold-settings', [ $this, 'settings' ] );
  }

  /**
   * Menu page callbacks
   *
   * @return void
   */
  public function plugin_scaffold() {
    $addressbook = new Plugin_Menu();
		$addressbook->plugin_main_manu_page();
  }

  /**
   * Settings page callbacks
   *
   * @return void
   */
  public function settings() {
    echo 'Settings Page';
  }
}
