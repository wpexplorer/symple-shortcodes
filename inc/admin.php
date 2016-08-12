<?php
/**
 * Adds admin panel with basic Symple Shortcode Settings
 *
 * @package   Symple Shortcodes
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.wpexplorer.com
 * @since     2.1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
if ( ! class_exists( 'Symple_Shortcodes_Admin' ) ) {

	class Symple_Shortcodes_Admin {

		/**
		 * Start things up
		 */
		public function __construct() {
			add_action( 'admin_menu', array( 'Symple_Shortcodes_Admin', 'add_page' ) );
			add_action( 'admin_init', array( 'Symple_Shortcodes_Admin', 'register_page_options' ) );
		}

		/**
		 * Add sub menu page
		 *
		 * @since 2.1.0
		 */
		public static function add_page() {
			add_submenu_page(
				'options-general.php',
				'Symple Shortcodes',
				'Symple Shortcodes',
				'administrator',
				'symple-shortcodes',
				array( 'Symple_Shortcodes_Admin', 'create_admin_page' )
			);
		}

		/**
		 * Function that will register admin page options.
		 *
		 * @since 2.1.0
		 */
		public static function register_page_options() {

			// Register Setting
			register_setting( 'symple_shortcodes', 'symple_shortcodes', array( 'Symple_Shortcodes_Admin', 'sanitize' ) );

			// Add main section to our options page
			add_settings_section( 'symple_shortcode_main', false, array( 'Symple_Shortcodes_Admin', 'section_main_callback' ), 'symple-shortcodes' );

			add_settings_field(
				'symple_shortcodes_google_map_api',
				esc_html__( 'Google Map API Key', 'symple' ),
				array( 'Symple_Shortcodes_Admin', 'google_map_api' ),
				'symple-shortcodes',
				'symple_shortcode_main'
			);

		}

		/**
		 * Sanitization callback
		 *
		 * @since 2.1.0
		 */
		public static function sanitize( $options ) {
			return $options;
		}

		/**
		 * Main Settings section callback
		 *
		 * @since 2.1.0
		 */
		public static function section_main_callback() {
			// Leave blank
		}

		/**
		 * Fields callback functions
		 *
		 * @since 2.1.0
		 */

		// Google Map Api Key
		public static function google_map_api() {
			$options = get_option( 'symple_shortcodes' );
			$val = isset( $options['google_maps_api'] ) ? $options['google_maps_api'] : ''; ?>
			<input type="text" name="symple_shortcodes[google_maps_api]" value="<?php echo esc_attr( $val ); ?>">
			<br />
			<small><a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank"><?php esc_html_e( 'Learn More', 'symple' ); ?> &rarr;</a></small>
		<?php }

		/**
		 * Settings page output
		 *
		 * @since 2.1.0
		 */
		public static function create_admin_page() { ?>
			<div class="wrap">
				<h2 style="padding-right:0;"><?php echo esc_html__( 'Symple Shortcodes', 'symple' ); ?></h2>
				<form method="post" action="options.php">
					<?php settings_fields( 'symple_shortcodes' ); ?>
					<?php do_settings_sections( 'symple-shortcodes' ); ?>
					<?php submit_button(); ?>
				</form>
			</div>
		<?php }


	}

	new Symple_Shortcodes_Admin();

}