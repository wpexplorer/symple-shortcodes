<?php
/*
Plugin Name: Symple Shortcodes
Plugin URI: http://www.wpexplorer.com/symple-shortcodes
Description: A free shortcodes plugin with support for the Visual Composer page builder.
Author: AJ Clarke
Author URI: http://www.wpexplorer.com
Version: 2.1.3
License: GNU General Public License version 2.0
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! class_exists( 'SympleShortcodes' ) ) {

	class SympleShortcodes {

		/**
		 * Main Constructor
		 *
		 * @since  2.0.0
		 * @access public
		 */
		public function __construct() {

			// Plugin version Constant
			define( 'SYMPLE_SHORTCODES_VERSION', '2.1.3' );
			define( 'SYMPLE_SHORTCODES_PLUGIN_SLUG', plugin_basename( __FILE__ ) );

			// Define path
			$this->dir_path = plugin_dir_path( __FILE__ );

			// Register de-activation hook
			register_deactivation_hook( __FILE__, array( $this, 'on_deactivation' ) );

			// Admin only
			if ( is_admin() ) {

				// MCE button
				add_action( 'admin_head', array( $this, 'add_mce_button' ) );
				add_action( 'admin_enqueue_scripts', array( $this, 'mce_css' ) );

				// Auto updates
				require_once( $this->dir_path .'/inc/updates.php' );

				// Admin panel
				require_once( $this->dir_path .'/inc/admin.php' );

				// Admin notices
				add_action( 'admin_init', array( $this, 'admin_notice_init' ) );

			}

			// Front end only
			else {

				// Front-end scripts
				add_action( 'wp_enqueue_scripts', array( $this, 'load_scripts' ) );

				// Add responsive tag to body
				add_filter( 'body_class', array( $this, 'body_class' ) );

			}

			// Test domain
			add_action( 'plugins_loaded', array( $this, 'load_text_domain' ) );

			// Image resizer class
			require_once( $this->dir_path .'/inc/image-resizer.php' );

			// Common functions
			require_once( $this->dir_path .'/inc/commons.php' );

			// The actual shortcode functions
			require_once( $this->dir_path .'/shortcodes/shortcodes.php' );

			// Map shortcodes to the Visual Composer
			require_once( $this->dir_path .'/visual-composer/map.php' );

		}

		/**
		 * Load Text Domain for translations
		 *
		 * @since  2.0.0
		 * @access public
		 */
		function load_text_domain() {
			load_plugin_textdomain( 'symple', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/');
		}

		/**
		 * Add filters for the TinyMCE buttton
		 *
		 * @since  2.0.0
		 * @access public
		 */
		function add_mce_button() {

			// Check user permissions
			if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
				return;
			}

			// Check if WYSIWYG is enabled
			if ( 'true' == get_user_option( 'rich_editing' ) ) {
				add_filter( 'mce_external_plugins', array( $this, 'add_tinymce_plugin' ) );
				add_filter( 'mce_buttons', array( $this, 'register_mce_button' ) );
			}

		}

		/**
		 * Loads the TinyMCE button js file
		 *
		 * @since  2.0.0
		 * @access public
		 */
		function add_tinymce_plugin( $plugin_array ) {
			$plugin_array['symple_shortcodes_mce_button'] = plugins_url( '/tinymce/symple_shortcodes_tinymce.js', __FILE__ );
			return $plugin_array;
		}

		/**
		 * Adds the TinyMCE button to the post editor buttons
		 *
		 * @since  2.0.0
		 * @access public
		 */
		function register_mce_button( $buttons ) {
			array_push( $buttons, 'symple_shortcodes_mce_button' );
			return $buttons;
		}

		/**
		 * Loads custom CSS for the TinyMCE editor button
		 *
		 * @since  2.0.0
		 * @access public
		 */
		function mce_css() {
			wp_enqueue_style('symple_shortcodes-tc', plugins_url( '/tinymce/symple_shortcodes_tinymce_style.css', __FILE__ ) );
		}

		/**
		 * Registers/Enqueues all scripts and styles
		 *
		 * @since  2.0.0
		 * @access public
		 */
		function load_scripts() {

			// Get options
			$options = get_option( 'symple_shortcodes' );

			// Define js directory
			$js_dir = plugin_dir_url( __FILE__ ) . 'shortcodes/js/';

			// Define CSS directory
			$css_dir = plugin_dir_url( __FILE__ ) . 'shortcodes/css/';

			// Core jQuery
			wp_enqueue_script( 'jquery' );

			// Tabs
			wp_register_script( 'symple_tabs', $js_dir . 'symple_tabs.js', array ( 'jquery', 'jquery-ui-tabs' ), '1.0', true );

			// Toggles
			wp_register_script( 'symple_toggle', $js_dir . 'symple_toggle.js', 'jquery', '1.0', true );

			// Accordions
			wp_register_script( 'symple_accordion', $js_dir . 'symple_accordion.js', array ( 'jquery', 'jquery-ui-accordion' ), '1.0', true );

			// Google Maps
			$g_api_key = isset( $options['google_maps_api'] ) ? $options['google_maps_api'] : '';
			$g_api_key = apply_filters( 'symple_shortcodes_google_map_api_key', $g_api_key );
			if ( $g_api_key ) {
				$g_api_key = '?key='. $g_api_key;
			}
			wp_register_script( 'symple_googlemap_api', 'https://maps.googleapis.com/maps/api/js'. $g_api_key, array( 'jquery' ), false, true );

			wp_register_script( 'symple_googlemap', $js_dir . 'symple_googlemap.js', array( 'jquery', 'symple_googlemap_api' ), '1.0', true );

			// Skillbar
			wp_register_script( 'symple_skillbar', $js_dir . 'symple_skillbar.js', array ( 'jquery' ), '1.0', true );
			
			// Lightbox
			wp_register_script( 'magnific-popup', $js_dir . 'magnific-popup.min.js', array ( 'jquery' ), '0.9.4', true );
			wp_register_script( 'symple_lightbox', $js_dir . 'symple_lightbox.js', array ( 'jquery', 'magnific-popup' ), '1.0', true );

			// Carousels
			wp_register_script( 'touchSwipe', $js_dir . 'touchSwipe.js', array ( 'jquery' ), '6.2.1', true );
			wp_register_script( 'caroufredsel', $js_dir . 'caroufredsel.js', array ( 'jquery', 'touchSwipe' ), '6.2.1', true );

			// Images Loaded
			wp_register_script( 'imagesLoaded', $js_dir . 'imagesLoaded.js', array ( 'jquery' ), '', true );
			
			// Slider
			wp_register_script( 'flexslider', $js_dir . 'flexslider.js', array ( 'jquery' ), '2.2.0', true );
			
			// Parallax
			wp_register_script( 'symple_parallax', $js_dir . 'symple_parallax.js', array ( 'jquery' ), '1.0', true );
			wp_register_script( 'symple_scroll_fade', $js_dir . 'symple_scroll_fade.js', array ( 'jquery' ), '1.0', true );

			// CSS
			wp_enqueue_style( 'symple_shortcode_styles', $css_dir . 'symple_shortcodes_styles.css' );
			wp_register_style( 'font-awesome', $css_dir . 'font-awesome.min.css' );
		}

		/**
		 * Add admin notice to enable the Visual Composer
		 *
		 * @since  2.0.0
		 * @access public
		 */
		function admin_notice_init() {

			// $this->vc_notice_dismiss_delete(); // For testing

			// If dismiss meta is saved bail
			if ( get_user_meta( get_current_user_id(), 'ss_vc_notice_dismiss', true ) ) {
				return;
			}

			// If the dimiss notice icon is clicked update user meta
			if ( isset( $_GET['ssvc-dismiss'] ) ) {
				$this->vc_notice_dismiss();
				return;
			}

			// Apply filters so you can disable the notice via the theme
			$show_vc_notice = apply_filters( 'symple_shortcodes_vc_notice', true );

			// Show notice
			if ( $show_vc_notice ) {
				add_action( 'admin_notices', array( $this, 'vc_notice' ) );
			}

		}

		/**
		 * Display admin notice for the VC
		 *
		 * @since  2.0.0
		 * @access public
		 */
		function vc_notice() { ?>
			
			<div class="updated notice is-dismissable symple-vc-notice">
				<a href="<?php echo esc_url( add_query_arg( 'ssvc-dismiss', '1' ) ); ?>" class="dismiss-notice" target="_parent"><span class="dashicons dashicons-no-alt" style="display:block;float:right;margin:10px 0 10px 10px;"></span></a>
				<p><?php _e( 'Symple Shortcodes includes support for the Visual Composer so you can use most of the modules via drag and drop.' ); ?></p><p><a href="http://www.wpexplorer.com/visual-composer-wordpress-plugin/" class="button button-primary" title="<?php _e( 'Visual Composer', 'wpex' ); ?>" target="_blank"><?php _e( 'Learn More', 'wpex' ); ?></a></p>
			</div>

		<?php }

		/**
		 * Update user meta for dismissing the notice
		 *
		 * @since 2.1.0
		 */
		public function vc_notice_dismiss() {
			update_user_meta( get_current_user_id(), 'ss_vc_notice_dismiss', 1 );
		}

		/**
		 * Delete notice dismiss
		 *
		 * @since 2.1.0
		 */
		public function vc_notice_dismiss_delete() {
			delete_user_meta( get_current_user_id(), 'ss_vc_notice_dismiss' );
		}

		/**
		 * Run on plugin de-activation
		 *
		 * @since 2.1.0
		 */
		public function on_deactivation() {

			// Remove user meta for the Visual Composer notice
			$this->vc_notice_dismiss_delete();

		}
		
		/**
		 * Adds classes to the body tag
		 *
		 * @since 2.1.0
		 */
		public function body_class( $classes ) {
			$classes[] = 'symple-shortcodes ';
			if ( apply_filters( 'symple_shortcodes_responsive', true ) ) {
				$classes[] = 'symple-shortcodes-responsive';
			}
			return $classes;
		}
		
	}

	// Start things up
	$symple_shortcodes = new SympleShortcodes();

}