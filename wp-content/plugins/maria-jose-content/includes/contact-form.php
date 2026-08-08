<?php
/**
 * Native booking form processing.
 *
 * @package Maria_Jose_Content
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Redirects back to the contact page with a form status.
 */
function maria_jose_content_contact_redirect( string $status, int $page_id = 0 ): void {
	$url = $page_id ? get_permalink( $page_id ) : home_url( '/contacto/' );
	wp_safe_redirect( add_query_arg( 'contact_status', $status, $url ) . '#formulario-contacto' );
	exit;
}

/**
 * Validates and sends booking requests through WordPress email.
 */
function maria_jose_content_process_contact_form(): void {
	$page_id = isset( $_POST['contact_page_id'] ) ? absint( $_POST['contact_page_id'] ) : 0;

	if (
		! isset( $_POST['maria_jose_contact_nonce'] ) ||
		! wp_verify_nonce(
			sanitize_text_field( wp_unslash( $_POST['maria_jose_contact_nonce'] ) ),
			'maria_jose_contact_submit'
		) ||
		! empty( $_POST['company'] )
	) {
		maria_jose_content_contact_redirect( 'error', $page_id );
	}

	$name       = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$phone      = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
	$email      = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$city       = isset( $_POST['city'] ) ? sanitize_text_field( wp_unslash( $_POST['city'] ) ) : '';
	$event_date = isset( $_POST['event_date'] ) ? sanitize_text_field( wp_unslash( $_POST['event_date'] ) ) : '';
	$event_type = isset( $_POST['event_type'] ) ? sanitize_text_field( wp_unslash( $_POST['event_type'] ) ) : '';
	$message    = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';
	$consent    = isset( $_POST['consent'] ) && '1' === $_POST['consent'];

	if ( ! $name || ! $phone || ! is_email( $email ) || ! $city || ! $event_type || ! $message || ! $consent ) {
		maria_jose_content_contact_redirect( 'error', $page_id );
	}

	$recipient = sanitize_email( (string) get_theme_mod( 'contact_email', get_option( 'admin_email' ) ) );
	$subject   = sprintf( __( 'Booking request from %s', 'maria-jose-content' ), $name );
	$body      = implode(
		"\n",
		array(
			__( 'New booking request', 'maria-jose-content' ),
			'',
			__( 'Name:', 'maria-jose-content' ) . ' ' . $name,
			__( 'Phone:', 'maria-jose-content' ) . ' ' . $phone,
			__( 'Email:', 'maria-jose-content' ) . ' ' . $email,
			__( 'City:', 'maria-jose-content' ) . ' ' . $city,
			__( 'Event date:', 'maria-jose-content' ) . ' ' . ( $event_date ?: __( 'Not specified', 'maria-jose-content' ) ),
			__( 'Event type:', 'maria-jose-content' ) . ' ' . $event_type,
			'',
			__( 'Message:', 'maria-jose-content' ),
			$message,
		)
	);
	$headers   = array( 'Reply-To: ' . $name . ' <' . $email . '>' );

	$sent = wp_mail( $recipient, $subject, $body, $headers );
	maria_jose_content_contact_redirect( $sent ? 'success' : 'error', $page_id );
}
add_action( 'admin_post_nopriv_maria_jose_contact', 'maria_jose_content_process_contact_form' );
add_action( 'admin_post_maria_jose_contact', 'maria_jose_content_process_contact_form' );

