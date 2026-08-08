<?php
/**
 * Template Name: Press / EPK
 * Template Post Type: page
 *
 * @package Maria_Jose
 */

get_header();
?>
<main id="contenido" class="epk-page">
	<?php
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/epk/hero' );
		get_template_part( 'template-parts/epk/facts' );
		get_template_part( 'template-parts/epk/biography' );
		get_template_part( 'template-parts/epk/downloads' );
		get_template_part( 'template-parts/epk/media' );
		get_template_part( 'template-parts/epk/booking' );
	}
	?>
</main>
<?php get_footer(); ?>

