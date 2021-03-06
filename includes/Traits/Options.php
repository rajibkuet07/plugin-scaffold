<?php

namespace Plugin\Scaffold\Traits;

/**
 * Options trait
 */
trait Options {
	/**
	 * Get option value for this plugin
	 * Main option is 'plugin_name' and its an array
	 * All other options are saved as the item of the array
	 *
	 * @param string $name
	 * @param mixed $default
	 * @return mixed
	 */
	public function get_option( $name, $default = false ) {
		$option = \get_option( 'plugin_scaffold' );
	
		if ( false === $option ) return $default;
	
		return isset( $option[ $name ] ) ? $option[ $name ] : $default;
	}
	
	/**
	 * Update option
	 *
	 * @param string $name
	 * @param mixed $value
	 * @return void
	 */
	public function update_option( $name, $value ) {
		$option = \get_option( 'plugin_scaffold' );
		$option = ( false === $option ) ? array() : (array) $option;
		$option = array_merge( $option, array( $name => $value ) );
	
		\update_option( 'plugin_scaffold', $option );
	}
}
