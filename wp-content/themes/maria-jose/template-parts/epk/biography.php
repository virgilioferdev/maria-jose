<?php
/**
 * Press biography.
 *
 * @package Maria_Jose
 */

$biography = trim( (string) get_the_content() );
?>
<section id="biografia-prensa" class="epk-section epk-biography">
	<div class="epk-shell">
		<header class="epk-section__heading">
			<div><span><?php esc_html_e( 'La artista', 'maria-jose' ); ?></span><h2><?php esc_html_e( 'Biografía oficial', 'maria-jose' ); ?></h2></div>
			<p><?php esc_html_e( 'Versión autorizada para medios', 'maria-jose' ); ?></p>
		</header>
		<div class="epk-biography__layout" data-reveal>
			<div class="epk-biography__copy">
				<?php
				if ( $biography ) {
					the_content();
				} else {
					echo wp_kses_post( wpautop( maria_jose_mod( 'about_copy', '' ) ) );
				}
				?>
			</div>
			<blockquote><?php esc_html_e( 'Canciones que nacen de la tierra y se cantan cerca.', 'maria-jose' ); ?></blockquote>
		</div>
	</div>
</section>
