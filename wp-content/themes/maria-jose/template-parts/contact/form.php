<?php
/**
 * Contact and booking form.
 *
 * @package Maria_Jose
 */

$email     = maria_jose_mod( 'contact_email', 'figueroafloresmariajose@gmail.com' );
$phone     = maria_jose_mod( 'contact_phone', '+591 69305185' );
$whatsapp  = maria_jose_mod( 'contact_whatsapp', 'https://wa.me/59169305185' );
$status    = isset( $_GET['contact_status'] ) ? sanitize_key( wp_unslash( $_GET['contact_status'] ) ) : '';
$event_types = array(
	''                 => __( 'Selecciona una opción', 'maria-jose' ),
	'festival'         => __( 'Festival o evento cultural', 'maria-jose' ),
	'private-event'    => __( 'Evento privado', 'maria-jose' ),
	'wedding'          => __( 'Boda', 'maria-jose' ),
	'press'            => __( 'Prensa o entrevista', 'maria-jose' ),
	'other'            => __( 'Otro', 'maria-jose' ),
);
?>
<section id="formulario-contacto" class="contact-section">
	<div class="contact-shell contact-layout">
		<aside class="contact-details" data-reveal>
			<span class="contact-label"><?php esc_html_e( 'Respuesta directa', 'maria-jose' ); ?></span>
			<h2><?php esc_html_e( '¿Prefieres WhatsApp?', 'maria-jose' ); ?></h2>
			<p><?php esc_html_e( 'Escríbenos con la fecha, ciudad y tipo de evento. Te responderemos con disponibilidad y próximos pasos.', 'maria-jose' ); ?></p>
			<a class="button button--primary" href="<?php echo esc_url( $whatsapp ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Consultar por WhatsApp', 'maria-jose' ); ?> →</a>
			<dl>
				<div><dt><?php esc_html_e( 'Email', 'maria-jose' ); ?></dt><dd><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></dd></div>
				<div><dt><?php esc_html_e( 'Teléfono', 'maria-jose' ); ?></dt><dd><a href="tel:<?php echo esc_attr( preg_replace( '/[^+\d]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a></dd></div>
				<div><dt><?php esc_html_e( 'Base', 'maria-jose' ); ?></dt><dd><?php esc_html_e( 'Tarija, Bolivia', 'maria-jose' ); ?></dd></div>
			</dl>
		</aside>

		<div class="contact-form-wrap" data-reveal>
			<span class="contact-label"><?php esc_html_e( 'Solicitud de contratación', 'maria-jose' ); ?></span>
			<h2><?php esc_html_e( 'Cuéntanos sobre tu evento', 'maria-jose' ); ?></h2>

			<?php if ( 'success' === $status ) : ?>
				<div class="contact-notice contact-notice--success" role="status"><?php esc_html_e( 'Gracias. Recibimos tu solicitud y nos pondremos en contacto contigo.', 'maria-jose' ); ?></div>
			<?php elseif ( 'error' === $status ) : ?>
				<div class="contact-notice contact-notice--error" role="alert"><?php esc_html_e( 'No pudimos enviar el mensaje. Revisa los datos o escríbenos por WhatsApp.', 'maria-jose' ); ?></div>
			<?php endif; ?>

			<form class="booking-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
				<input type="hidden" name="action" value="maria_jose_contact">
				<input type="hidden" name="contact_page_id" value="<?php echo esc_attr( get_the_ID() ); ?>">
				<?php wp_nonce_field( 'maria_jose_contact_submit', 'maria_jose_contact_nonce' ); ?>
				<div class="booking-form__honeypot" aria-hidden="true"><label for="contact_company">Company</label><input id="contact_company" name="company" type="text" tabindex="-1" autocomplete="off"></div>

				<div class="booking-form__grid">
					<label><span><?php esc_html_e( 'Nombre', 'maria-jose' ); ?> *</span><input name="name" type="text" autocomplete="name" required></label>
					<label><span><?php esc_html_e( 'WhatsApp o teléfono', 'maria-jose' ); ?> *</span><input name="phone" type="tel" autocomplete="tel" required></label>
					<label><span><?php esc_html_e( 'Correo electrónico', 'maria-jose' ); ?> *</span><input name="email" type="email" autocomplete="email" required></label>
					<label><span><?php esc_html_e( 'Ciudad', 'maria-jose' ); ?> *</span><input name="city" type="text" autocomplete="address-level2" required></label>
					<label><span><?php esc_html_e( 'Fecha del evento', 'maria-jose' ); ?></span><input name="event_date" type="date" min="<?php echo esc_attr( current_datetime()->format( 'Y-m-d' ) ); ?>"></label>
					<label><span><?php esc_html_e( 'Tipo de evento', 'maria-jose' ); ?> *</span><select name="event_type" required><?php foreach ( $event_types as $value => $label ) : ?><option value="<?php echo esc_attr( $value ); ?>"><?php echo esc_html( $label ); ?></option><?php endforeach; ?></select></label>
				</div>
				<label><span><?php esc_html_e( 'Cuéntanos los detalles', 'maria-jose' ); ?> *</span><textarea name="message" rows="6" required></textarea></label>
				<label class="booking-form__consent"><input name="consent" type="checkbox" value="1" required><span><?php esc_html_e( 'Acepto que mis datos sean utilizados para responder esta solicitud.', 'maria-jose' ); ?></span></label>
				<button class="button button--primary" type="submit"><?php esc_html_e( 'Enviar solicitud', 'maria-jose' ); ?> →</button>
			</form>
		</div>
	</div>
</section>
