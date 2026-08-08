<?php
/**
 * Custom fields for videos and live shows.
 *
 * @package Maria_Jose_Content
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers plugin meta boxes.
 */
function maria_jose_content_add_meta_boxes(): void {
	add_meta_box(
		'mj_video_details',
		__( 'Datos del video', 'maria-jose-content' ),
		'maria_jose_content_render_video_meta_box',
		'mj_video',
		'normal',
		'high'
	);

	add_meta_box(
		'mj_show_details',
		__( 'Datos de la presentación', 'maria-jose-content' ),
		'maria_jose_content_render_show_meta_box',
		'mj_show',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'maria_jose_content_add_meta_boxes' );

/**
 * Renders a reusable meta box input.
 */
function maria_jose_content_render_input(
	string $name,
	string $label,
	int $post_id,
	string $type = 'text'
): void {
	$value = get_post_meta( $post_id, "_{$name}", true );
	?>
	<p>
		<label for="<?php echo esc_attr( $name ); ?>"><strong><?php echo esc_html( $label ); ?></strong></label><br>
		<input class="widefat" id="<?php echo esc_attr( $name ); ?>" name="<?php echo esc_attr( $name ); ?>" type="<?php echo esc_attr( $type ); ?>" value="<?php echo esc_attr( $value ); ?>">
	</p>
	<?php
}

/**
 * Renders video metadata fields.
 */
function maria_jose_content_render_video_meta_box( WP_Post $post ): void {
	wp_nonce_field( 'maria_jose_content_save_meta', 'maria_jose_content_meta_nonce' );
	maria_jose_content_render_input( 'youtube_id', __( 'ID o URL de YouTube', 'maria-jose-content' ), $post->ID );
	maria_jose_content_render_input( 'video_type', __( 'Tipo (Video oficial, En vivo…)', 'maria-jose-content' ), $post->ID );
	maria_jose_content_render_input( 'duration', __( 'Duración', 'maria-jose-content' ), $post->ID );
	?>
	<p>
		<label for="featured_video">
			<input id="featured_video" name="featured_video" type="checkbox" value="1" <?php checked( get_post_meta( $post->ID, '_featured_video', true ), '1' ); ?>>
			<strong><?php esc_html_e( 'Mostrar como destacado en la página de inicio', 'maria-jose-content' ); ?></strong>
		</label>
	</p>
	<?php
}

/**
 * Renders live show metadata fields.
 */
function maria_jose_content_render_show_meta_box( WP_Post $post ): void {
	wp_nonce_field( 'maria_jose_content_save_meta', 'maria_jose_content_meta_nonce' );
	maria_jose_content_render_input( 'show_date', __( 'Fecha', 'maria-jose-content' ), $post->ID, 'date' );
	maria_jose_content_render_input( 'show_city', __( 'Lugar / ciudad', 'maria-jose-content' ), $post->ID );
}

/**
 * Saves plugin metadata after capability and nonce checks.
 */
function maria_jose_content_save_meta( int $post_id, WP_Post $post ): void {
	if (
		! in_array( $post->post_type, array( 'mj_video', 'mj_show' ), true ) ||
		! isset( $_POST['maria_jose_content_meta_nonce'] ) ||
		! wp_verify_nonce(
			sanitize_text_field( wp_unslash( $_POST['maria_jose_content_meta_nonce'] ) ),
			'maria_jose_content_save_meta'
		) ||
		( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) ||
		! current_user_can( 'edit_post', $post_id )
	) {
		return;
	}

	$fields = array(
		'mj_video' => array( 'youtube_id', 'video_type', 'duration' ),
		'mj_show'  => array( 'show_date', 'show_city' ),
	);

	foreach ( $fields[ $post->post_type ] as $field ) {
		if ( isset( $_POST[ $field ] ) ) {
			update_post_meta(
				$post_id,
				"_{$field}",
				sanitize_text_field( wp_unslash( $_POST[ $field ] ) )
			);
		}
	}

	if ( 'mj_video' === $post->post_type ) {
		update_post_meta( $post_id, '_featured_video', isset( $_POST['featured_video'] ) ? '1' : '0' );
	}
}
add_action( 'save_post', 'maria_jose_content_save_meta', 10, 2 );
