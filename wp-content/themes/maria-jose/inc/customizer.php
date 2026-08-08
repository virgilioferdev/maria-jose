<?php
/**
 * Native WordPress Customizer controls.
 *
 * @package Maria_Jose
 */

function maria_jose_customize_register( WP_Customize_Manager $wp_customize ): void {
	$sections = array(
		'hero'    => __( 'Portada', 'maria-jose' ),
		'about'   => __( 'Sobre María José', 'maria-jose' ),
		'contact' => __( 'Contacto y redes', 'maria-jose' ),
	);

	foreach ( $sections as $id => $title ) {
		$wp_customize->add_section( "maria_jose_{$id}", array( 'title' => $title, 'priority' => 30 ) );
	}

	$fields = array(
		'hero_eyebrow' => array( 'Artista Tarijeña', 'hero', 'text' ),
		'hero_title'   => array( 'Música que abraza', 'hero', 'text' ),
		'hero_copy'    => array( 'Canciones nacidas entre coplas, cuecas y noches de vendimia. Una propuesta cálida para escenarios íntimos, festivales y encuentros donde la música se canta cerca.', 'hero', 'textarea' ),
		'about_title'  => array( 'Sobre mí', 'about', 'text' ),
		'about_copy'   => array( 'María José canta desde la raíz chapaca con canciones llenas de alegría, energía de fiesta y una presencia pensada para conectar con públicos de todas las edades.', 'about', 'textarea' ),
		'contact_email'=> array( 'figueroafloresmariajose@gmail.com', 'contact', 'email' ),
		'contact_phone'=> array( '+591 69305185', 'contact', 'text' ),
		'contact_whatsapp' => array( 'https://wa.me/59169305185?text=Hola%20Mar%C3%ADa%20Jos%C3%A9%2C%20quisiera%20consultar%20sobre%20contrataciones.', 'contact', 'url' ),
		'social_instagram' => array( 'https://www.instagram.com/maria_jose_oficial_9/', 'contact', 'url' ),
		'social_tiktok'    => array( 'https://www.tiktok.com/@mariajoseoficial95', 'contact', 'url' ),
		'social_youtube'   => array( 'https://youtube.com/@mariajosefigueroa6865', 'contact', 'url' ),
		'social_facebook'  => array( 'https://www.facebook.com/profile.php?id=100077422277320', 'contact', 'url' ),
	);

	foreach ( $fields as $id => $config ) {
		list( $default, $section, $type ) = $config;
		$sanitize = 'sanitize_text_field';
		if ( 'textarea' === $type ) { $sanitize = 'sanitize_textarea_field'; }
		if ( 'email' === $type ) { $sanitize = 'sanitize_email'; }
		if ( 'url' === $type ) { $sanitize = 'esc_url_raw'; }

		$wp_customize->add_setting( $id, array( 'default' => $default, 'sanitize_callback' => $sanitize ) );
		$wp_customize->add_control( $id, array( 'label' => ucwords( str_replace( '_', ' ', $id ) ), 'section' => "maria_jose_{$section}", 'type' => $type ) );
	}

	$wp_customize->add_setting( 'hero_image', array( 'sanitize_callback' => 'absint' ) );
	$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'hero_image', array( 'label' => __( 'Imagen principal', 'maria-jose' ), 'section' => 'maria_jose_hero', 'mime_type' => 'image' ) ) );
	$wp_customize->add_setting( 'about_image', array( 'sanitize_callback' => 'absint' ) );
	$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'about_image', array( 'label' => __( 'Retrato', 'maria-jose' ), 'section' => 'maria_jose_about', 'mime_type' => 'image' ) ) );
}
add_action( 'customize_register', 'maria_jose_customize_register' );

