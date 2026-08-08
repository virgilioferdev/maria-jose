<?php
/**
 * Plugin Name: María José Content
 * Plugin URI:  https://mariajoseoficial.com/
 * Description: Manages videos and live shows for the María José website.
 * Version:     1.0.0
 * Author:      Virgilio Fernández
 * Text Domain: maria-jose-content
 * Domain Path: /languages
 * Requires PHP: 8.0
 *
 * @package Maria_Jose_Content
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'MARIA_JOSE_CONTENT_VERSION', '1.0.0' );
define( 'MARIA_JOSE_CONTENT_DIR', plugin_dir_path( __FILE__ ) );

require_once MARIA_JOSE_CONTENT_DIR . 'includes/content-types.php';
require_once MARIA_JOSE_CONTENT_DIR . 'includes/meta-boxes.php';

/**
 * Loads plugin translations.
 */
function maria_jose_content_load_textdomain(): void {
	load_plugin_textdomain(
		'maria-jose-content',
		false,
		dirname( plugin_basename( __FILE__ ) ) . '/languages'
	);
}
add_action( 'plugins_loaded', 'maria_jose_content_load_textdomain' );

/**
 * Registers content types and refreshes rewrite rules on activation.
 */
function maria_jose_content_activate(): void {
	maria_jose_content_register_post_types();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'maria_jose_content_activate' );

/**
 * Refreshes rewrite rules after deactivation.
 */
function maria_jose_content_deactivate(): void {
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'maria_jose_content_deactivate' );

