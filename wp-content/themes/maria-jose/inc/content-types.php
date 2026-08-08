<?php
/**
 * Videos and live shows managed without third-party plugins.
 *
 * @package Maria_Jose
 */

function maria_jose_register_content_types(): void {
	register_post_type(
		'mj_video',
		array(
			'labels' => array( 'name' => __( 'Videos', 'maria-jose' ), 'singular_name' => __( 'Video', 'maria-jose' ), 'add_new_item' => __( 'Añadir video', 'maria-jose' ), 'edit_item' => __( 'Editar video', 'maria-jose' ) ),
			'public' => true, 'show_in_rest' => true, 'menu_icon' => 'dashicons-video-alt3', 'supports' => array( 'title', 'page-attributes' ), 'has_archive' => false,
		)
	);
	register_post_type(
		'mj_show',
		array(
			'labels' => array( 'name' => __( 'Agenda', 'maria-jose' ), 'singular_name' => __( 'Presentación', 'maria-jose' ), 'add_new_item' => __( 'Añadir presentación', 'maria-jose' ), 'edit_item' => __( 'Editar presentación', 'maria-jose' ) ),
			'public' => true, 'show_in_rest' => true, 'menu_icon' => 'dashicons-calendar-alt', 'supports' => array( 'title', 'editor' ), 'has_archive' => false,
		)
	);
}
add_action( 'init', 'maria_jose_register_content_types' );

function maria_jose_add_meta_boxes(): void {
	add_meta_box( 'mj_video_details', __( 'Datos del video', 'maria-jose' ), 'maria_jose_video_meta_box', 'mj_video', 'normal', 'high' );
	add_meta_box( 'mj_show_details', __( 'Datos de la presentación', 'maria-jose' ), 'maria_jose_show_meta_box', 'mj_show', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'maria_jose_add_meta_boxes' );

function maria_jose_meta_input( string $name, string $label, int $post_id, string $type = 'text' ): void {
	$value = get_post_meta( $post_id, "_{$name}", true );
	printf( '<p><label for="%1$s"><strong>%2$s</strong></label><br><input class="widefat" id="%1$s" name="%1$s" type="%3$s" value="%4$s"></p>', esc_attr( $name ), esc_html( $label ), esc_attr( $type ), esc_attr( $value ) );
}

function maria_jose_video_meta_box( WP_Post $post ): void {
	wp_nonce_field( 'maria_jose_save_meta', 'maria_jose_meta_nonce' );
	maria_jose_meta_input( 'youtube_id', __( 'ID o URL de YouTube', 'maria-jose' ), $post->ID );
	maria_jose_meta_input( 'video_type', __( 'Tipo (Video oficial, En vivo…)', 'maria-jose' ), $post->ID );
	maria_jose_meta_input( 'duration', __( 'Duración', 'maria-jose' ), $post->ID );
}

function maria_jose_show_meta_box( WP_Post $post ): void {
	wp_nonce_field( 'maria_jose_save_meta', 'maria_jose_meta_nonce' );
	maria_jose_meta_input( 'show_date', __( 'Fecha', 'maria-jose' ), $post->ID, 'date' );
	maria_jose_meta_input( 'show_city', __( 'Lugar / ciudad', 'maria-jose' ), $post->ID );
}

function maria_jose_save_meta( int $post_id ): void {
	if ( ! isset( $_POST['maria_jose_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['maria_jose_meta_nonce'] ) ), 'maria_jose_save_meta' ) || ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	$fields = array( 'youtube_id', 'video_type', 'duration', 'show_date', 'show_city' );
	foreach ( $fields as $field ) {
		if ( isset( $_POST[ $field ] ) ) {
			update_post_meta( $post_id, "_{$field}", sanitize_text_field( wp_unslash( $_POST[ $field ] ) ) );
		}
	}
}
add_action( 'save_post', 'maria_jose_save_meta' );

