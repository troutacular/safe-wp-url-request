<?php
/**
 * WordPress safe URL request function.
 *
 * @package wp_safe_url_request
 * @since 1.0.0
 */

/**
 * WordPress safe URL request
 *
 * Gets the body content from the requested URL.
 *
 * @usage wp_safe_url_request( 'http://some.site.com' );
 * @param string $url   URL requested.
 * @param array  $args  Arguments to use with wp_safe_remote_get.
 * @return string       Output of URL <body>
 */
function wp_safe_url_request( $url, $args = null ) {

	// Default the response to null.
	$response = null;

	// Get the global WP version.
	global $wp_version;

	// Check if any custom arguments have been passed.
	if ( null === $args ) {
		$args = array(
			'timeout'     => 5,
			'redirection' => 5,
			'httpversion' => '1.0',
			'user-agent'  => 'WordPress/' . $wp_version . '; ' . home_url(),
			'blocking'    => true,
			'headers'     => array(),
			'cookies'     => array(),
			'body'        => null,
			'compress'    => false,
			'decompress'  => true,
			'sslverify'   => true,
			'stream'      => false,
			'filename'    => null,
		);
	}

	// Get the remote data.
	$response = wp_safe_remote_get( $url, $args );

	// Check if there is a wordpress error.
	if ( is_wp_error( $response ) ) {

		// Return the WP Error message.
		return $response->get_error_message();
	}

	// Check if there is an HTTP error 400 and above.
	if ( $response['response']['code'] >= 400 ) {

		// Return the error response code and message.
		return $response['response']['code'] . ': ' . $response['response']['message'];

	}

	// Check if we have an array for the response.
	if ( is_array( $response ) && '' !== $response['body'] ) {
		$response = $response['body'];
	}

	return $response;

}
