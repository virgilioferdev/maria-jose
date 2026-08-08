<?php
/** @package Maria_Jose */
get_header();
?>
<main id="contenido" class="content-shell section error-page"><p class="eyebrow">404</p><h1><?php esc_html_e( 'Esta página no está en el repertorio.', 'maria-jose' ); ?></h1><a class="button button--primary" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Volver al inicio', 'maria-jose' ); ?></a></main>
<?php get_footer(); ?>
