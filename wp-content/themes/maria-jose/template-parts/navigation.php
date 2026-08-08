<?php
/** @package Maria_Jose */
?>
<nav class="site-nav" aria-label="<?php esc_attr_e( 'Navegación principal', 'maria-jose' ); ?>">
	<?php get_template_part( 'template-parts/brand' ); ?>
	<button class="nav-toggle" type="button" aria-expanded="false" aria-controls="primary-menu"><span></span><span></span><span></span><span class="screen-reader-text"><?php esc_html_e( 'Abrir menú', 'maria-jose' ); ?></span></button>
	<div id="primary-menu" class="site-nav__panel">
		<?php
		if ( has_nav_menu( 'primary' ) ) {
			wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'site-nav__links', 'fallback_cb' => false, 'depth' => 1 ) );
		} else {
			?>
			<div class="site-nav__links"><a href="#inicio">Inicio</a><a href="#videos">Videos</a><a href="#agenda">Agenda</a><a href="#sobre-mi">Sobre mí</a><a href="#contacto">Contacto</a></div>
			<?php
		}
		maria_jose_render_social_links();
		?>
	</div>
</nav>

