<?php
/**
 * Plugin Name:       Nakamoto Notes Bitcoin Barometer
 * Plugin URI:        https://nakamotonotes.com/open
 * Description:       Shows the Nakamoto Notes Bitcoin Barometer, a 0 to 100 Bitcoin market reading, with a shortcode or a block.
 * Version:           1.0.0
 * Requires at least: 6.7
 * Requires PHP:      7.4
 * Author:            NakamotoNotes
 * Author URI:        https://nakamotonotes.com
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       nakamoto-notes-bitcoin-barometer
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * This plugin makes no HTTP request itself. It prints an iframe; the visitor's browser loads
 * https://nakamotonotes.com/embed/barometer (see "External services" in readme.txt).
 */

/**
 * Render the Barometer iframe for the shortcode and the block.
 *
 * @param array $atts Shortcode attributes or block attributes: style (compact|full), height (pixels).
 * @return string
 */
function nnbaro_render( $atts ) {
	$atts   = shortcode_atts(
		array(
			'style'  => 'full',
			'height' => 0,
		),
		(array) $atts,
		'nn_barometer'
	);
	$style  = ( 'compact' === $atts['style'] ) ? 'compact' : 'full';
	$height = absint( $atts['height'] );
	if ( ! $height ) {
		$height = ( 'compact' === $style ) ? 185 : 470;
	}
	$width = ( 'compact' === $style ) ? 340 : 380;
	$src   = 'https://nakamotonotes.com/embed/barometer?style=' . $style . '&utm=wp';

	$out  = '<iframe src="' . esc_url( $src ) . '" width="' . esc_attr( $width ) . '" height="' . esc_attr( $height ) . '" loading="lazy" title="Bitcoin Barometer" style="border:0;max-width:100%"></iframe>';
	$out .= '<noscript><a href="https://nakamotonotes.com/open">View the Bitcoin Barometer</a></noscript>';
	if ( get_option( 'nnbaro_show_credit', 0 ) ) {
		$out .= '<p><a href="https://nakamotonotes.com/open">Powered by NakamotoNotes</a></p>';
	}
	return $out;
}
add_shortcode( 'nn_barometer', 'nnbaro_render' );

/**
 * Register the block. It is rendered on the server; the editor builds its settings panel from the attributes.
 */
function nnbaro_register_block() {
	register_block_type(
		'nnbaro/barometer',
		array(
			'api_version'     => 3,
			'title'           => 'Bitcoin Barometer',
			'description'     => 'Shows the Nakamoto Notes Bitcoin Barometer reading.',
			'category'        => 'widgets',
			'attributes'      => array(
				'style'  => array(
					'type'    => 'string',
					'enum'    => array( 'compact', 'full' ),
					'default' => 'full',
				),
				'height' => array(
					'type'    => 'integer',
					'default' => 0,
				),
			),
			'supports'        => array( 'autoRegister' => true ),
			'render_callback' => 'nnbaro_render',
		)
	);
}
add_action( 'init', 'nnbaro_register_block' );

/**
 * The credit link is opt-in and off by default (wordpress.org guideline 10).
 *
 * @param mixed $value Submitted value.
 * @return int
 */
function nnbaro_sanitize_credit( $value ) {
	return $value ? 1 : 0;
}

function nnbaro_register_settings() {
	register_setting(
		'nnbaro',
		'nnbaro_show_credit',
		array(
			'type'              => 'integer',
			'sanitize_callback' => 'nnbaro_sanitize_credit',
			'default'           => 0,
		)
	);
}
add_action( 'admin_init', 'nnbaro_register_settings' );

function nnbaro_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	echo '<div class="wrap"><h1>' . esc_html__( 'Bitcoin Barometer', 'nakamoto-notes-bitcoin-barometer' ) . '</h1>';
	echo '<form method="post" action="options.php">';
	settings_fields( 'nnbaro' );
	echo '<label><input type="checkbox" name="nnbaro_show_credit" value="1" ' . checked( 1, get_option( 'nnbaro_show_credit', 0 ), false ) . '> ' . esc_html__( 'Show a Powered by NakamotoNotes link below the widget', 'nakamoto-notes-bitcoin-barometer' ) . '</label>';
	submit_button();
	echo '</form></div>';
}

function nnbaro_add_menu() {
	add_options_page(
		__( 'Bitcoin Barometer', 'nakamoto-notes-bitcoin-barometer' ),
		__( 'Bitcoin Barometer', 'nakamoto-notes-bitcoin-barometer' ),
		'manage_options',
		'nnbaro',
		'nnbaro_settings_page'
	);
}
add_action( 'admin_menu', 'nnbaro_add_menu' );
