<?php
/** @package Maria_Jose */
$email = maria_jose_mod( 'contact_email', 'figueroafloresmariajose@gmail.com' );
$phone = maria_jose_mod( 'contact_phone', '+591 69305185' );
$whatsapp = maria_jose_mod( 'contact_whatsapp', 'https://wa.me/59169305185?text=Hola%20Mar%C3%ADa%20Jos%C3%A9%2C%20quisiera%20consultar%20sobre%20contrataciones.' );
?>
<footer id="contacto" class="site-footer">
	<div class="site-footer__inner">
		<div class="site-footer__brand"><?php get_template_part( 'template-parts/brand', null, array( 'url' => '#inicio' ) ); ?><?php maria_jose_render_social_links( 'footer-socials' ); ?></div>
		<div><h2><?php esc_html_e( 'Contacto / Booking', 'maria-jose' ); ?></h2><p><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></p><p><a href="tel:<?php echo esc_attr( preg_replace( '/[^+\d]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a></p><div class="site-footer__actions"><a class="button button--primary" href="<?php echo esc_url( $whatsapp ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Escribir por WhatsApp', 'maria-jose' ); ?></a><a class="button button--ghost" href="mailto:<?php echo esc_attr( $email ); ?>"><?php esc_html_e( 'Enviar email', 'maria-jose' ); ?></a></div></div>
		<div><h2><?php esc_html_e( 'Contrataciones', 'maria-jose' ); ?></h2><p><?php esc_html_e( 'Para fechas, prensa o presentaciones privadas, envía un mensaje directo y coordinamos los detalles.', 'maria-jose' ); ?></p><a class="footer-link" href="<?php echo esc_url( $whatsapp ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Consultar disponibilidad', 'maria-jose' ); ?></a></div>
	</div>
	<div class="site-footer__legal"><span>© <?php echo esc_html( wp_date( 'Y' ) ); ?> María José</span><a href="#inicio"><?php esc_html_e( 'Volver arriba ↑', 'maria-jose' ); ?></a></div>
</footer>
