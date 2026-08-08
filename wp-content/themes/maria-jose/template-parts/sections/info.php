<?php
/** @package Maria_Jose */
$shows = get_posts( array( 'post_type' => 'mj_show', 'posts_per_page' => 6, 'meta_key' => '_show_date', 'orderby' => 'meta_value', 'order' => 'ASC' ) );
$about_image_id = (int) get_theme_mod( 'about_image' );
$about_image = $about_image_id ? wp_get_attachment_image_url( $about_image_id, 'large' ) : MARIA_JOSE_URI . '/assets/images/about-maria-jose.jpg';
?>
<section class="section info-grid">
	<div id="agenda" class="agenda" data-reveal>
		<?php maria_jose_section_heading( 'Agenda' ); ?>
		<div class="shows">
			<?php if ( $shows ) : foreach ( $shows as $show ) : $date = (string) get_post_meta( $show->ID, '_show_date', true ); $timestamp = strtotime( $date ); ?>
				<article class="show"><time datetime="<?php echo esc_attr( $date ); ?>"><strong><?php echo esc_html( $timestamp ? wp_date( 'd', $timestamp ) : '—' ); ?></strong><span><?php echo esc_html( $timestamp ? strtoupper( wp_date( 'M', $timestamp ) ) : '' ); ?></span></time><div><h3><?php echo esc_html( $show->post_title ); ?></h3><p><?php echo esc_html( get_post_meta( $show->ID, '_show_city', true ) ); ?></p></div></article>
			<?php endforeach; else : ?>
				<article class="show"><time datetime="2026-07-19"><strong>19</strong><span>JUL</span></time><div><h3>Fiesta San Santiago</h3><p>Campo de Vasco, Tarija</p></div></article>
			<?php endif; ?>
		</div>
	</div>
	<div id="sobre-mi" class="about" data-reveal>
		<?php maria_jose_section_heading( maria_jose_mod( 'about_title', 'Sobre mí' ) ); ?>
		<div class="about__content"><img src="<?php echo esc_url( $about_image ); ?>" alt="<?php esc_attr_e( 'Retrato de María José', 'maria-jose' ); ?>" loading="lazy"><div><p><?php echo esc_html( maria_jose_mod( 'about_copy', 'María José canta desde la raíz chapaca con canciones llenas de alegría, energía de fiesta y una presencia pensada para conectar con públicos de todas las edades.' ) ); ?></p><a class="button button--ghost" href="#contacto"><?php esc_html_e( 'Conocer más', 'maria-jose' ); ?></a></div></div>
	</div>
</section>

