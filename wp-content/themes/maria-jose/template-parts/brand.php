<?php
/** @package Maria_Jose */
$brand_url = isset( $args['url'] ) ? $args['url'] : home_url( '/' );
?>
<a class="brand" href="<?php echo esc_url( $brand_url ); ?>" aria-label="<?php esc_attr_e( 'María José — Inicio', 'maria-jose' ); ?>">
	<?php if ( has_custom_logo() ) : ?>
		<?php echo wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'full' ); ?>
	<?php else : ?>
		<img src="<?php echo esc_url( MARIA_JOSE_URI . '/assets/images/logo-maria-jose.png' ); ?>" alt="<?php esc_attr_e( 'María José — Voz de mi tierra', 'maria-jose' ); ?>">
	<?php endif; ?>
</a>
