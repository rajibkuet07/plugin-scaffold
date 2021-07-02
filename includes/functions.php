<?php

/**
 * Get the option
 *
 * @param string $name
 * @param mixed $default
 * @return void
 */
function get_option( $name, $default = false ) {
	$option = get_option( 'plugin_scaffold' );

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
function update_option( $name, $value ) {
	$option = get_option( 'plugin_scaffold' );
	$option = ( false === $option ) ? array() : (array) $option;
	$option = array_merge( $option, array( $name => $value ) );
	update_option( 'plugin_scaffold', $option );
}
