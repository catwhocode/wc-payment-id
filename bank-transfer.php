<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) { 
    exit; // Exit if accessed directly
}

/* @wordpress-plugin
 * Plugin Name: 		Bank Indonesia for WooCommerce
 * Plugin URI: 			https://ibest.id
 * Description: 		Kumpulan bank Indonesia untuk gateway pembayaran offline di eCommerce yang mendukung WooCommerce. Plugin ini memungkinkan pemilik eCommerce untuk mengatur gateway pembayaran offline menggunakan bank Indonesia melalui transfer bank ke pelanggan mereka.
 * Version: 			1.3.0
 * Author: 			Reynaldi Arya
 * Author URI: 			https://ibest.id
 * Domain Path:			/languages
 * Requires at least: 		4.1
 * Tested up to: 		5.7.2
 * WC requires at least: 	3.0.0
 * WC tested up to: 		5.4.1
 * License: 			GNU General Public License v3.0
 * License URI: 		http://www.gnu.org/licenses/gpl-3.0.html
 */

// Make sure we don't expose any info if called directly
add_action( 'plugins_loaded', 'bank_indonesia_init', 0 );

function bank_indonesia_init() {

	if ( ! class_exists( 'WC_Payment_Gateway' ) ) {
		return;
	}

	DEFINE ('BI_PLUGIN_DIR', plugins_url( basename( plugin_dir_path( __FILE__ ) ), basename( __FILE__ ) ) . '/' );
	DEFINE ('BI_PLUGIN_VERSION', get_file_data(__FILE__, array('Version' => 'Version'), false)['Version'] );

	require_once dirname( __FILE__ ) . '/bank/bni.php';
	require_once dirname( __FILE__ ) . '/bank/bca.php';
	require_once dirname( __FILE__ ) . '/bank/bri.php';
	require_once dirname( __FILE__ ) . '/bank/mandiri.php';
	require_once dirname( __FILE__ ) . '/e-money/ovo.php';
	require_once dirname( __FILE__ ) . '/e-money/gopay.php';
	require_once dirname( __FILE__ ) . '/e-money/dana.php';
	require_once dirname( __FILE__ ) . '/e-money/linkaja.php';
	require_once dirname( __FILE__ ) . '/settings.php';

	add_filter( 'woocommerce_payment_gateways', 'add_bank_indonesia_gateway' );
}

function add_bank_indonesia_gateway( $methods ) {
	$methods[] = 'WC_Gateway_BNI';
	$methods[] = 'WC_Gateway_BCA';
	$methods[] = 'WC_Gateway_BRI';
	$methods[] = 'WC_Gateway_Mandiri';
	$methods[] = 'WC_Gateway_GoPay';
	$methods[] = 'WC_Gateway_OVO';	
	$methods[] = 'WC_Gateway_Dana';
	$methods[] = 'WC_Gateway_LinkAja';
	return $methods;
}