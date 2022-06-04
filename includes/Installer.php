<?php

namespace Plugin\Scaffold;

use Plugin\Scaffold\Traits\Options;

/**
 * Installer class
 * Does the stuffs on plugin activation
 */
class Installer {
	use Options;

	private $required_php_version = '5.6.0';

	/**
	 * Constructor of Installer class
	 */
	public function install() {
		if ( ! $this->is_valid_php_version() ) {
			$this->abort_activation();
		}

		$this->track_version();

		$this->install_tables();
	}

	/**
	 * Extra information about the installation
	 * will be stored in the database as options
	 *
	 * @return void
	 */
	private function track_version() {
		// save the installation time for future use
		$installed = $this->get_option( 'installed', false );

		$installed || $this->update_option( 'installed', time() );

		// save the version of the plugin as option
		$prev_version = $this->get_option( 'version', '0' );
		$new_version  = PLUGIN_SCAFFOLD_VERSION;

		( $prev_version === $new_version ) || $this->update_option( 'version', $new_version );
	}

	/**
	 * Create all the necessary tables
	 *
	 * @return void
	 */
	private function install_tables() {
		// Install tables if any
	}

	/**
	 * Check PHP version
	 *
	 * @return boolean
	 */
	private function is_valid_php_version() {
		$php_version  = phpversion();
		$php_compat   = version_compare( $php_version, $this->required_php_version, '>=' );

		return $php_compat;
	}

	/**
	 * Abort plugin activation if php version is not compatible
	 *
	 * @return void
	 */
	private function abort_activation() {
		$php_version   = phpversion();

		// translators: %s: URL to Update PHP page.
		$php_update_message = '</p><p>' . sprintf(
			__( '<a href="%s">Learn more about updating PHP</a>.', 'plugin-scaffold' ),
			esc_url( wp_get_update_php_url() )
		);

		$message = sprintf(
			// translators: 1: URL to WordPress release notes, 2: WordPress version number, 3: Minimum required PHP version number, 4: Current PHP version number.
			__( '%1$s requires PHP version %2$s or higher. You are running version %3$s', 'plugin-scaffold' ),
			ucfirst( preg_replace( '/-|_/', ' ', PLUGIN_SCAFFOLD_NAME ) ),
			$this->required_php_version,
			$php_version
		) . $php_update_message;

		exit( $message );
	}
}

