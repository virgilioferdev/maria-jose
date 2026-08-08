<?php
/** @package Maria_Jose */
$video_posts = get_posts( array( 'post_type' => 'mj_video', 'posts_per_page' => 12, 'orderby' => array( 'menu_order' => 'ASC', 'date' => 'DESC' ) ) );
$videos = array();
foreach ( $video_posts as $video_post ) {
	$id = maria_jose_youtube_id( (string) get_post_meta( $video_post->ID, '_youtube_id', true ) );
	if ( $id ) {
		$videos[] = array( 'id' => $id, 'title' => $video_post->post_title, 'type' => (string) get_post_meta( $video_post->ID, '_video_type', true ), 'duration' => (string) get_post_meta( $video_post->ID, '_duration', true ) );
	}
}
$active = $videos ? $videos[0] : null;
?>
<section id="videos" class="section videos">
	<?php maria_jose_section_heading( 'Videos', maria_jose_mod( 'social_youtube', '#' ), 'Ver todos' ); ?>
	<?php if ( $active ) : ?>
		<div class="video-player" data-video-player data-reveal>
			<div class="video-player__media"><iframe src="https://www.youtube-nocookie.com/embed/<?php echo esc_attr( $active['id'] ); ?>?rel=0" title="<?php echo esc_attr( $active['title'] ); ?>" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen loading="lazy"></iframe></div>
			<div class="video-player__info"><span data-video-type><?php echo esc_html( $active['type'] ); ?></span><h3 data-video-title><?php echo esc_html( $active['title'] ); ?></h3><p><?php esc_html_e( 'Selecciona otro video de la lista para reproducirlo aquí mismo.', 'maria-jose' ); ?></p></div>
		</div>
		<div class="video-carousel" data-carousel>
			<button class="carousel-control carousel-control--prev" type="button" data-carousel-prev aria-label="<?php esc_attr_e( 'Videos anteriores', 'maria-jose' ); ?>">←</button>
			<div class="video-carousel__track" data-carousel-track tabindex="0">
				<?php foreach ( $videos as $index => $item ) : ?>
					<button class="video-card" type="button" data-video-id="<?php echo esc_attr( $item['id'] ); ?>" data-video-title="<?php echo esc_attr( $item['title'] ); ?>" data-video-type="<?php echo esc_attr( $item['type'] ); ?>" aria-pressed="<?php echo 0 === $index ? 'true' : 'false'; ?>">
						<span class="video-card__thumb"><img src="https://img.youtube.com/vi/<?php echo esc_attr( $item['id'] ); ?>/hqdefault.jpg" alt="" loading="lazy"><i aria-hidden="true">▶</i><?php if ( $item['duration'] ) : ?><small><?php echo esc_html( $item['duration'] ); ?></small><?php endif; ?></span>
						<strong><?php echo esc_html( $item['title'] ); ?></strong><span><?php echo esc_html( $item['type'] ); ?></span>
					</button>
				<?php endforeach; ?>
			</div>
			<button class="carousel-control carousel-control--next" type="button" data-carousel-next aria-label="<?php esc_attr_e( 'Videos siguientes', 'maria-jose' ); ?>">→</button>
		</div>
	<?php else : ?>
		<p class="videos__empty"><?php esc_html_e( 'No hay videos publicados en este momento.', 'maria-jose' ); ?></p>
	<?php endif; ?>
</section>
