<?php
/**
 * Theme setup and assets.
 *
 * @package Maria_Jose
 */

function maria_jose_setup(): void {
	load_theme_textdomain( 'maria-jose', MARIA_JOSE_DIR . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 120,
			'width'       => 360,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	register_nav_menus(
		array(
			'primary' => __( 'Navegación principal', 'maria-jose' ),
			'footer'  => __( 'Navegación del pie', 'maria-jose' ),
		)
	);
}
add_action( 'after_setup_theme', 'maria_jose_setup' );

function maria_jose_assets(): void {
	$css_path = MARIA_JOSE_DIR . '/assets/dist/css/main.css';
	$js_path  = MARIA_JOSE_DIR . '/assets/dist/js/main.js';
	$css_ver  = file_exists( $css_path ) ? (string) filemtime( $css_path ) : MARIA_JOSE_VERSION;
	$js_ver   = file_exists( $js_path ) ? (string) filemtime( $js_path ) : MARIA_JOSE_VERSION;

	wp_enqueue_style( 'maria-jose', MARIA_JOSE_URI . '/assets/dist/css/main.css', array(), $css_ver );
	wp_enqueue_script( 'maria-jose', MARIA_JOSE_URI . '/assets/dist/js/main.js', array(), $js_ver, true );
	wp_script_add_data( 'maria-jose', 'strategy', 'defer' );
}
add_action( 'wp_enqueue_scripts', 'maria_jose_assets' );

function maria_jose_resource_hints( array $urls, string $relation_type ): array {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = array( 'href' => 'https://fonts.googleapis.com', 'crossorigin' => 'anonymous' );
		$urls[] = array( 'href' => 'https://fonts.gstatic.com', 'crossorigin' => 'anonymous' );
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'maria_jose_resource_hints', 10, 2 );

