<?php
/**
 * Video archive template.
 *
 * @package Maria_Jose
 */

get_header();

$video_posts = get_posts(
	array(
		'post_type'      => 'mj_video',
		'posts_per_page' => -1,
		'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'DESC' ),
	)
);
$videos = array();

foreach ( $video_posts as $video_post ) {
	$youtube_id = maria_jose_youtube_id( (string) get_post_meta( $video_post->ID, '_youtube_id', true ) );

	if ( ! $youtube_id ) {
		continue;
	}

	$videos[] = array(
		'id'          => $youtube_id,
		'title'       => $video_post->post_title,
		'type'        => (string) get_post_meta( $video_post->ID, '_video_type', true ),
		'duration'    => (string) get_post_meta( $video_post->ID, '_duration', true ),
		'description' => wp_strip_all_tags( $video_post->post_content ),
	);
}

$featured    = $videos ? $videos[0] : null;
$social_links = maria_jose_social_links();
$youtube_url = $social_links['YT'] ?? '';
?>
<main id="contenido" class="video-archive">
	<header class="video-archive__hero">
		<div class="video-archive__container video-archive__hero-inner" data-reveal>
			<span><?php esc_html_e( 'Música desde Tarija', 'maria-jose' ); ?></span>
			<h1><?php post_type_archive_title(); ?></h1>
			<p><?php esc_html_e( 'Presentaciones, videoclips y canciones que celebran la música tarijeña y sus raíces.', 'maria-jose' ); ?></p>
		</div>
	</header>

	<div class="video-archive__container video-archive__content">
		<?php if ( $featured ) : ?>
			<section class="video-archive__featured" data-video-player>
				<div class="video-archive__heading">
					<h2><?php esc_html_e( 'Video destacado', 'maria-jose' ); ?></h2>
					<?php if ( $youtube_url ) : ?>
						<a href="<?php echo esc_url( $youtube_url ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Canal de YouTube', 'maria-jose' ); ?><span aria-hidden="true"> ↗</span><span class="screen-reader-text"><?php esc_html_e( ' (abre en una pestaña nueva)', 'maria-jose' ); ?></span></a>
					<?php endif; ?>
				</div>
				<div class="video-player" data-reveal>
					<div class="video-player__media"><iframe src="https://www.youtube-nocookie.com/embed/<?php echo esc_attr( $featured['id'] ); ?>?rel=0&amp;controls=1&amp;playsinline=1" title="<?php echo esc_attr( $featured['title'] ); ?>" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe></div>
					<div class="video-player__info">
						<span data-video-type><?php echo esc_html( $featured['type'] ); ?></span>
						<h3 data-video-title><?php echo esc_html( $featured['title'] ); ?></h3>
						<p data-video-description><?php echo esc_html( $featured['description'] ?: __( 'Disfruta de la música y las presentaciones de María José.', 'maria-jose' ) ); ?></p>
					</div>
				</div>
			</section>

			<section class="video-archive__catalog">
				<div class="video-archive__heading"><h2><?php esc_html_e( 'Todos los videos', 'maria-jose' ); ?></h2></div>
				<div class="video-grid">
					<?php foreach ( $videos as $index => $video ) : ?>
						<button class="video-card" type="button" data-video-id="<?php echo esc_attr( $video['id'] ); ?>" data-video-title="<?php echo esc_attr( $video['title'] ); ?>" data-video-type="<?php echo esc_attr( $video['type'] ); ?>" data-video-description="<?php echo esc_attr( $video['description'] ); ?>" aria-pressed="<?php echo 0 === $index ? 'true' : 'false'; ?>">
							<span class="video-card__thumb"><img src="https://img.youtube.com/vi/<?php echo esc_attr( $video['id'] ); ?>/hqdefault.jpg" alt="" loading="lazy"><i aria-hidden="true">▶</i><?php if ( $video['duration'] ) : ?><small><?php echo esc_html( $video['duration'] ); ?></small><?php endif; ?></span>
							<strong><?php echo esc_html( $video['title'] ); ?></strong><span><?php echo esc_html( $video['type'] ); ?></span>
						</button>
					<?php endforeach; ?>
				</div>
			</section>
		<?php else : ?>
			<p class="videos__empty"><?php esc_html_e( 'No hay videos publicados en este momento.', 'maria-jose' ); ?></p>
		<?php endif; ?>

		<section class="video-archive__cta" data-reveal>
			<div><h2><?php esc_html_e( '¿Quieres contratar a María José?', 'maria-jose' ); ?></h2><p><?php esc_html_e( 'Conversemos sobre tu evento, festival o celebración.', 'maria-jose' ); ?></p></div>
			<a class="button button--ghost" href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>"><?php esc_html_e( 'Consultar disponibilidad', 'maria-jose' ); ?></a>
		</section>
	</div>
</main>
<?php
get_footer();
