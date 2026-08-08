<?php
/**
 * Downloadable press resources.
 *
 * @package Maria_Jose
 */

$photo_url = MARIA_JOSE_URI . '/assets/images/about-maria-jose.jpg';
$logo_url  = MARIA_JOSE_URI . '/assets/images/logo-maria-jose.png';
?>
<section id="recursos-prensa" class="epk-section epk-downloads">
	<div class="epk-shell">
		<header class="epk-section__heading">
			<div><span><?php esc_html_e( 'Recursos oficiales', 'maria-jose' ); ?></span><h2><?php esc_html_e( 'Descargas para prensa', 'maria-jose' ); ?></h2></div>
			<p><?php esc_html_e( 'Material autorizado para publicación', 'maria-jose' ); ?></p>
		</header>
		<div class="epk-downloads__grid" data-reveal>
			<article class="epk-resource">
				<span class="epk-resource__icon" aria-hidden="true">◫</span>
				<div><h3><?php esc_html_e( 'Fotografía oficial', 'maria-jose' ); ?></h3><p><?php esc_html_e( 'Imagen en alta resolución · JPG', 'maria-jose' ); ?></p></div>
				<a href="<?php echo esc_url( $photo_url ); ?>" download><?php esc_html_e( 'Descargar fotografía ↓', 'maria-jose' ); ?></a>
			</article>
			<article class="epk-resource">
				<span class="epk-resource__icon" aria-hidden="true">✦</span>
				<div><h3><?php esc_html_e( 'Logo oficial', 'maria-jose' ); ?></h3><p><?php esc_html_e( 'Fondo transparente · PNG', 'maria-jose' ); ?></p></div>
				<a href="<?php echo esc_url( $logo_url ); ?>" download><?php esc_html_e( 'Descargar logo ↓', 'maria-jose' ); ?></a>
			</article>
			<article class="epk-resource">
				<span class="epk-resource__icon" aria-hidden="true">≡</span>
				<div><h3><?php esc_html_e( 'Biografía', 'maria-jose' ); ?></h3><p><?php esc_html_e( 'Texto oficial para medios', 'maria-jose' ); ?></p></div>
				<a href="#biografia-prensa"><?php esc_html_e( 'Leer biografía ↑', 'maria-jose' ); ?></a>
			</article>
		</div>
	</div>
</section>

