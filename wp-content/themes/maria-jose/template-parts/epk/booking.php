<?php
/**
 * Press kit booking call to action.
 *
 * @package Maria_Jose
 */

$whatsapp = maria_jose_mod( 'contact_whatsapp', 'https://wa.me/59169305185' );
?>
<section id="contacto-booking" class="epk-booking">
	<div class="epk-shell epk-booking__layout">
		<div><span><?php esc_html_e( 'Contrataciones y prensa', 'maria-jose' ); ?></span><h2><?php esc_html_e( 'Hablemos de tu próximo evento', 'maria-jose' ); ?></h2><p><?php esc_html_e( 'Festivales · Eventos culturales · Presentaciones privadas', 'maria-jose' ); ?></p></div>
		<a class="button epk-booking__button" href="<?php echo esc_url( $whatsapp ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Consultar disponibilidad', 'maria-jose' ); ?> →</a>
	</div>
</section>

