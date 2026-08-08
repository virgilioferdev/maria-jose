<?php
/**
 * María José theme bootstrap.
 *
 * @package Maria_Jose
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'MARIA_JOSE_VERSION', '1.0.0' );
define( 'MARIA_JOSE_DIR', get_template_directory() );
define( 'MARIA_JOSE_URI', get_template_directory_uri() );

require_once MARIA_JOSE_DIR . '/inc/setup.php';
require_once MARIA_JOSE_DIR . '/inc/content-types.php';
require_once MARIA_JOSE_DIR . '/inc/customizer.php';
require_once MARIA_JOSE_DIR . '/inc/template-tags.php';

