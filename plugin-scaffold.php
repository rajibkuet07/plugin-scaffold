<?php
/**
 * @wordpress-plugin
 * Plugin Name:       Plugin Scaffold
 * Plugin URI:        https://example.com/plugin-scaffold/
 * Description:       A fully object oriented boilerplate for WordPress Plugin created by the developer for the developers.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Your Name
 * Author URI:        https://example.com/
 * Text Domain:       plugin-scaffold
 * Domain Path:       /languages/
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

use Plugin\Scaffold\Admin\Menu;

/**
 * Do not allow direct access
 */
defined( 'ABSPATH' ) || die( 'Just go away!' );

require_once __DIR__ . '/vendor/autoload.php';

/**
 * The main class of the plugin
 * This class will have only one instance throughout the whole lifecycle of the plugin.
 */
if ( ! class_exists( 'Plugin_Scaffold' ) ) {
  final class Plugin_Scaffold {
    private static $instance  = null;
    const version             = '1.0.0';

    /**
     * Class contructor
     * Private. So object can not be created using new keyword.
     */
    private function __construct() {
      $this->define_constants();

      register_activation_hook( __FILE__, [ $this, 'activate' ] );
      register_deactivation_hook( __FILE__, [ $this, 'deactivate' ] );

      add_action( 'plugins_loaded', [ $this, 'initialize_plugin' ] );

			// add_action( 'admin_notices', [ $this, 'php_version_error_notice' ] );
    }

    /**
     * Instantiate the class instance.
     * Will always return the same instance
     *
     * @return \Plugin_Scaffold this class instance
     */
    public static function init() {
      if ( self::$instance === null ) {
        self::$instance = new Self();
      }

      return self::$instance;
    }

    /**
     * Define constants
     *
     * @return void
     */
    private static function define_constants() {
			defined( 'PLUGIN_SCAFFOLD_VERSION' ) || define( 'PLUGIN_SCAFFOLD_VERSION', self::version );
			defined( 'PLUGIN_SCAFFOLD_FILE' ) || define( 'PLUGIN_SCAFFOLD_FILE', __FILE__ );
			defined( 'PLUGIN_SCAFFOLD_DIR' ) || define( 'PLUGIN_SCAFFOLD_DIR', untrailingslashit( __DIR__ ) );
			defined( 'PLUGIN_SCAFFOLD_BASENAME' ) || define( 'PLUGIN_SCAFFOLD_BASENAME', plugin_basename( PLUGIN_SCAFFOLD_FILE ) );
			defined( 'PLUGIN_SCAFFOLD_NAME' ) || define( 'PLUGIN_SCAFFOLD_NAME', trim( dirname( PLUGIN_SCAFFOLD_BASENAME ), '/' ) );
			defined( 'PLUGIN_SCAFFOLD_URL' ) || define( 'PLUGIN_SCAFFOLD_URL', untrailingslashit( plugins_url( '', PLUGIN_SCAFFOLD_FILE ) ) );
			defined( 'PLUGIN_SCAFFOLD_INC_DIR' ) || define( 'PLUGIN_SCAFFOLD_INC_DIR', PLUGIN_SCAFFOLD_DIR . '/includes' );
			defined( 'PLUGIN_SCAFFOLD_ASSETS' ) || define( 'PLUGIN_SCAFFOLD_ASSETS', trailingslashit( PLUGIN_SCAFFOLD_URL ) . 'assets' );
    }

    /**
     * Define a constant after checking if it is not exist
     *
     * @param string $name
     * @param string|bool $value
     * 
     * @return void
     */
    private static function define( $name, $value ) {
      if ( ! defined( $name ) ) {
          define( $name, $value );
      }
    }

    /**
     * Do the necessary tasks on plugin activation
     *
     * @return void
     */
    public function activate() {
			$installer = new \Plugin\Scaffold\Installer();
      $installer->install();
    }

    /**
     * Do the necessary tasks on plugin deactivation
     *
     * @return void
     */
    public function deactivate() {
			// do tasks after deactivation
    }

    /**
     * Initialize the plugin
     *
     * @return void
     */
    public function initialize_plugin() {
      if ( is_admin() ) {
        new Plugin\Scaffold\Admin();
      } else {
        new Plugin\Scaffold\Frontend();
      }
    }

		/**
		 * PHP version error notice
		 *
		 * @return void
		 */
		/* public function php_version_error_notice() {
			if ( ! $message = get_transient( '_php_version_error_notice' ) ) {
				return;
			}
			echo sprintf( '<div class="notice notice-warning is-dismissible">
				<p><strong>%1$s</strong></p>
			</div>
			<button type="button" class="notice-dismiss">
				<span class="screen-reader-text">Dismiss this notice.</span>
			</button>', $message );
			delete_transient( '_php_version_error_notice' );
		} */
  }
}

/**
 * Inititalize the main plugin class
 *
 * @return \Plugin_Scaffold
 */
function plugin_scaffold() {
  return Plugin_Scaffold::init();
}

/**
 * Lets start the plugin
 */
plugin_scaffold();
