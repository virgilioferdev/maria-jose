<?php
/** @package Maria_Jose */
$videos = get_posts( array( 'post_type' => 'mj_video', 'posts_per_page' => 1, 'orderby' => array( 'menu_order' => 'ASC', 'date' => 'DESC' ) ) );
$video  = $videos ? $videos[0] : null;
$video_id = $video ? maria_jose_youtube_id( (string) get_post_meta( $video->ID, '_youtube_id', true ) ) : 'en3a9dWLkz4';
$video_title = $video ? $video->post_title : 'Punto Final';
$default_image = MARIA_JOSE_URI . '/assets/images/hero-band.jpg';
$hero_image_id = (int) get_theme_mod( 'hero_image' );
$hero_image = $hero_image_id ? wp_get_attachment_image_url( $hero_image_id, 'full' ) : $default_image;
$title = maria_jose_mod( 'hero_title', 'Música que abraza' );
$title_words = preg_split( '/\s+/', trim( $title ) );
$accent = array_pop( $title_words );
?>
<section id="inicio" class="hero" aria-label="<?php esc_attr_e( 'Presentación de María José', 'maria-jose' ); ?>">
	<img class="hero__image" src="<?php echo esc_url( $hero_image ); ?>" alt="" fetchpriority="high">
	<div class="hero__shade" aria-hidden="true"></div>
	<?php get_template_part( 'template-parts/navigation' ); ?>
	<div class="hero__content">
		<div class="hero__copy-wrap" data-reveal>
			<p class="eyebrow"><?php echo esc_html( maria_jose_mod( 'hero_eyebrow', 'Artista Tarijeña' ) ); ?></p>
			<h1><?php echo esc_html( implode( ' ', $title_words ) ); ?> <span><?php echo esc_html( $accent ); ?></span></h1>
			<p class="hero__copy"><?php echo esc_html( maria_jose_mod( 'hero_copy', 'Canciones nacidas entre coplas, cuecas y noches de vendimia. Una propuesta cálida para escenarios íntimos, festivales y encuentros donde la música se canta cerca.' ) ); ?></p>
			<div class="hero__actions"><a class="button button--primary" href="#videos" data-select-video="<?php echo esc_attr( $video_id ); ?>"><?php esc_html_e( 'Ver video destacado', 'maria-jose' ); ?></a><a class="button button--ghost" href="#agenda"><?php esc_html_e( 'Ver agenda', 'maria-jose' ); ?></a></div>
		</div>
		<a class="feature-video" href="#videos" data-select-video="<?php echo esc_attr( $video_id ); ?>" style="--feature-image:url('https://img.youtube.com/vi/<?php echo esc_attr( $video_id ); ?>/hqdefault.jpg')" data-reveal>
			<span><?php esc_html_e( 'Video destacado', 'maria-jose' ); ?></span><strong>María José · <?php echo esc_html( $video_title ); ?></strong><i aria-hidden="true">▶</i>
		</a>
	</div>
</section>

