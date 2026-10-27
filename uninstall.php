<?php
/**
 * Removes the plugin's single option on uninstall.
 *
 * @package nakamoto-notes-bitcoin-barometer
 */

if ( ! defined( 'ABSPATH' ) || ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

delete_option( 'nnbaro_show_credit' );
