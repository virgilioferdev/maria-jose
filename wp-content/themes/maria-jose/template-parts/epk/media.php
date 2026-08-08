<?php
/**
 * Featured press media.
 *
 * @package Maria_Jose
 */

$videos = get_posts(
	array(
		'post_type'      => 'mj_video',
		'post_status'    => 'publish',
		'posts_per_page' => 4,
		'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'DESC' ),
	)
);
$featured = $videos ? $videos[0] : null;
$featured_id = $featured ? maria_jose_youtube_id( (string) get_post_meta( $featured->ID, '_youtube_id', true ) ) : '';
?>
<?php if ( $featured_id ) : ?>
	<section class="epk-section epk-media">
		<div class="epk-shell">
			<header class="epk-section__heading">
				<div><span><?php esc_html_e( 'Música y video', 'maria-jose' ); ?></span><h2><?php esc_html_e( 'Material destacado', 'maria-jose' ); ?></h2></div>
				<p><?php esc_html_e( 'Selección para productores y medios', 'maria-jose' ); ?></p>
			</header>
			<div class="epk-media__layout" data-reveal>
				<div class="epk-media__video"><iframe src="https://www.youtube-nocookie.com/embed/<?php echo esc_attr( $featured_id ); ?>?rel=0&amp;controls=1&amp;playsinline=1" title="<?php echo esc_attr( $featured->post_title ); ?>" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen loading="lazy"></iframe></div>
				<div class="epk-tracklist">
					<h3><?php esc_html_e( 'Selección audiovisual', 'maria-jose' ); ?></h3>
					<?php foreach ( $videos as $video ) : ?>
						<div><strong><?php echo esc_html( $video->post_title ); ?></strong><span><?php echo esc_html( get_post_meta( $video->ID, '_video_type', true ) ); ?></span></div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>

