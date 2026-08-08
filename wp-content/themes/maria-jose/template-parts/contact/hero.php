<?php
/**
 * Contact page hero.
 *
 * @package Maria_Jose
 */

$intro = has_excerpt()
	? get_the_excerpt()
	: __( 'Cuéntanos sobre tu evento y recibe información sobre disponibilidad, formatos de presentación y contratación.', 'maria-jose' );
?>
<section class="contact-hero">
	<div class="contact-shell contact-hero__content" data-reveal>
		<p class="eyebrow"><?php esc_html_e( 'Contrataciones · Prensa · Eventos', 'maria-jose' ); ?></p>
		<h1><?php esc_html_e( 'Hagamos que tu evento suene diferente', 'maria-jose' ); ?></h1>
		<p><?php echo esc_html( $intro ); ?></p>
	</div>
</section>

