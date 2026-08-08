<?php
/**
 * Reusable presentation helpers.
 *
 * @package Maria_Jose
 */

function maria_jose_mod( string $key, string $fallback = '' ): string {
	$value = get_theme_mod( $key, false );

	return false === $value || '' === $value ? $fallback : (string) $value;
}

function maria_jose_social_links(): array {
	return array_filter(
		array(
			'IG' => maria_jose_mod( 'social_instagram', 'https://www.instagram.com/maria_jose_oficial_9/' ),
			'TK' => maria_jose_mod( 'social_tiktok', 'https://www.tiktok.com/@mariajoseoficial95' ),
			'YT' => maria_jose_mod( 'social_youtube', 'https://youtube.com/@mariajosefigueroa6865' ),
			'FB' => maria_jose_mod( 'social_facebook', 'https://www.facebook.com/profile.php?id=100077422277320' ),
		)
	);
}

function maria_jose_render_social_links( string $class = 'socials' ): void {
	?>
	<div class="<?php echo esc_attr( $class ); ?>" aria-label="<?php esc_attr_e( 'Redes sociales', 'maria-jose' ); ?>">
		<?php foreach ( maria_jose_social_links() as $label => $url ) : ?>
			<a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $label ); ?></a>
		<?php endforeach; ?>
	</div>
	<?php
}

function maria_jose_section_heading(
	string $title,
	string $url = '',
	string $label = '',
	bool $open_in_new_tab = false
): void {
	?>
	<div class="section-heading">
		<div><h2><?php echo esc_html( $title ); ?></h2><span aria-hidden="true"></span></div>
		<?php if ( $url && $label ) : ?>
			<a class="section-link" href="<?php echo esc_url( $url ); ?>"<?php echo $open_in_new_tab ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>>
				<?php echo esc_html( $label ); ?>
				<?php if ( $open_in_new_tab ) : ?>
					<span class="screen-reader-text"><?php esc_html_e( ' (abre en una pestaña nueva)', 'maria-jose' ); ?></span>
				<?php endif; ?>
			</a>
		<?php endif; ?>
	</div>
	<?php
}

function maria_jose_youtube_id( string $value ): string {
	if ( preg_match( '~(?:youtu\.be/|youtube\.com/(?:watch\?v=|embed/|shorts/))([\w-]{11})~', $value, $matches ) ) {
		return $matches[1];
	}

	return preg_match( '/^[\w-]{11}$/', $value ) ? $value : '';
}
