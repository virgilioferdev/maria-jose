<?php
/**
 * Press kit hero.
 *
 * @package Maria_Jose
 */

$intro = has_excerpt()
	? get_the_excerpt()
	: __( 'Material oficial para medios, productores, festivales y organizaciones interesadas en presentar y contratar a la artista.', 'maria-jose' );
$portrait = get_the_post_thumbnail_url( get_the_ID(), 'large' );
if ( ! $portrait ) {
	$portrait = MARIA_JOSE_URI . '/assets/images/about-maria-jose.jpg';
}
?>
<section class="epk-hero">
	<div class="epk-shell epk-hero__layout">
		<div class="epk-hero__copy" data-reveal>
			<p class="eyebrow"><?php esc_html_e( 'Kit de prensa oficial', 'maria-jose' ); ?> · <?php echo esc_html( wp_date( 'Y' ) ); ?></p>
			<h1><?php esc_html_e( 'María José, voz chapaca contemporánea', 'maria-jose' ); ?></h1>
			<p><?php echo esc_html( $intro ); ?></p>
			<div class="epk-hero__actions">
				<a class="button button--primary" href="#recursos-prensa"><?php esc_html_e( 'Ver recursos de prensa', 'maria-jose' ); ?></a>
				<a class="button button--ghost" href="#contacto-booking"><?php esc_html_e( 'Contacto de booking', 'maria-jose' ); ?></a>
			</div>
		</div>
		<figure class="epk-portrait" data-reveal>
			<img src="<?php echo esc_url( $portrait ); ?>" alt="<?php esc_attr_e( 'Fotografía oficial de María José', 'maria-jose' ); ?>">
			<figcaption><?php esc_html_e( 'Fotografía oficial', 'maria-jose' ); ?></figcaption>
		</figure>
	</div>
</section>

