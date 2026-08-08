<?php
/**
 * Custom post type registration.
 *
 * @package Maria_Jose_Content
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers the video and live show post types.
 */
function maria_jose_content_register_post_types(): void {
	register_post_type(
		'mj_video',
		array(
			'labels' => array(
				'name'          => __( 'Videos', 'maria-jose-content' ),
				'singular_name' => __( 'Video', 'maria-jose-content' ),
				'add_new_item'  => __( 'Añadir video', 'maria-jose-content' ),
				'edit_item'     => __( 'Editar video', 'maria-jose-content' ),
			),
			'public'       => true,
			'show_in_rest' => true,
			'menu_icon'    => 'dashicons-video-alt3',
			'supports'     => array( 'title', 'editor', 'page-attributes' ),
			'has_archive'  => 'videos',
			'rewrite'      => array( 'slug' => 'videos' ),
		)
	);

	register_post_type(
		'mj_show',
		array(
			'labels' => array(
				'name'          => __( 'Agenda', 'maria-jose-content' ),
				'singular_name' => __( 'Presentación', 'maria-jose-content' ),
				'add_new_item'  => __( 'Añadir presentación', 'maria-jose-content' ),
				'edit_item'     => __( 'Editar presentación', 'maria-jose-content' ),
			),
			'public'       => true,
			'show_in_rest' => true,
			'menu_icon'    => 'dashicons-calendar-alt',
			'supports'     => array( 'title', 'editor' ),
			'has_archive'  => false,
			'rewrite'      => array( 'slug' => 'agenda' ),
		)
	);
}
add_action( 'init', 'maria_jose_content_register_post_types' );
