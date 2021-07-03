<?php

namespace Plugin\Scaffold\Admin;

/**
 * The menu handler class
 */
class Menu {
	/**
	 * Plugin page object
	 *
	 * @var \Plugin_Menu_Pages
	 */
	private $plugin_pages;

  /**
	 * Constructor of Menu class
	 *
	 * @param \Plugin_Menu_Pages $plugin_pages
	 */
  public function __construct( $plugin_pages ) {
		$this->plugin_pages = $plugin_pages;

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

    add_menu_page(
			__( 'Plugin Scaffold', 'plugin-scaffold' ),
			__( 'Plugin Scaffold', 'plugin-scaffold' ),
			$capability,
			'plugin-scaffold',
			[ $this->plugin_pages, 'main_menu_page' ],
			'dashicons-smiley',
			81
		);
    add_submenu_page(
			$parent_slug,
			__( 'Submenu Title', 'plugin-scaffold' ),
			__( 'Submenu Title', 'plugin-scaffold' ),
			$capability,
			$parent_slug,
			[ $this->plugin_pages, 'main_menu_page' ]
		);
    add_submenu_page(
			$parent_slug,
			__( 'Another Submneu Title', 'plugin-scaffold' ),
			__( 'Another Submneu Title', 'plugin-scaffold' ),
			$capability,
			'plugin-scaffold-another-submenu',
			[ $this->plugin_pages, 'another_submenu_page' ]
		);
		// add more if you need
  }
}
