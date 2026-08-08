<?php
/**
 * Template Name: Contact / Booking
 * Template Post Type: page
 *
 * @package Maria_Jose
 */

get_header();
?>
<main id="contenido" class="contact-page">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'template-parts/contact/hero' ); ?>
		<?php get_template_part( 'template-parts/contact/form' ); ?>
	<?php endwhile; ?>
</main>
<?php get_footer(); ?>

