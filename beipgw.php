<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) { 
    exit; // Exit if accessed directly
}

/* @wordpress-plugin
 * Plugin Name: 			iBestPay - Bank dan e-Money Indonesia
 * Plugin URI: 				https://toko.ibest.id
 * Description: 			The WooCommerce Bank and e-Money Indonesia Payment Gateway plugin consists of several collections of banks and e-Money in Indonesia for WooCommerce payments.
 * Version: 				2.0.0
 * Author: 					Reynaldi Arya
 * Author URI: 				https://ibest.id
 * Domain Path:				/languages
 * Requires at least: 		4.1
 * Tested up to: 			5.7.2
 * WC requires at least: 	3.0.0
 * WC tested up to: 		5.4.1
 * License: 				GNU General Public License v3.0
 * License URI: 			http://www.gnu.org/licenses/gpl-3.0.html
 */

// Make sure we don't expose any info if called directly
add_action( 'plugins_loaded', 'beipgw_init', 0 );
add_filter ( 'woocommerce_payment_gateways', 'add_beipgw_gateway' );

function beipgw_init() {

	if ( ! class_exists( 'WC_Payment_Gateway' ) ) {
		return;
	}

	require_once dirname( __FILE__ ) . '/bank/class-wc-gateway-bni.php';
	require_once dirname( __FILE__ ) . '/bank/class-wc-gateway-bca.php';
	require_once dirname( __FILE__ ) . '/bank/class-wc-gateway-bri.php';
	require_once dirname( __FILE__ ) . '/bank/class-wc-gateway-mandiri.php';
	require_once dirname( __FILE__ ) . '/bank/class-wc-gateway-jago.php';
	require_once dirname( __FILE__ ) . '/bank/class-wc-gateway-cimb-niaga.php';
	require_once dirname( __FILE__ ) . '/bank/class-wc-gateway-citibank.php';
	require_once dirname( __FILE__ ) . '/bank/class-wc-gateway-digibank.php';
	require_once dirname( __FILE__ ) . '/bank/class-wc-gateway-hsbc.php';
	require_once dirname( __FILE__ ) . '/bank/class-wc-gateway-jenius.php';
	require_once dirname( __FILE__ ) . '/bank/class-wc-gateway-neo-commerce.php';
	require_once dirname( __FILE__ ) . '/bank/class-wc-gateway-danamon.php';
	require_once dirname( __FILE__ ) . '/bank/class-wc-gateway-btn.php';
	require_once dirname( __FILE__ ) . '/bank/class-wc-gateway-bsi.php';
	require_once dirname( __FILE__ ) . '/bank/class-wc-gateway-permata.php';
	require_once dirname( __FILE__ ) . '/bank/class-wc-gateway-ocbc-nisp.php';
	require_once dirname( __FILE__ ) . '/e-money/class-wc-gateway-ovo.php';
	require_once dirname( __FILE__ ) . '/e-money/class-wc-gateway-gopay.php';
	require_once dirname( __FILE__ ) . '/e-money/class-wc-gateway-dana.php';
	require_once dirname( __FILE__ ) . '/e-money/class-wc-gateway-linkaja.php';
	require_once dirname( __FILE__ ) . '/settings.php';

}

function add_beipgw_gateway( $methods ) {
	$methods[] = 'WC_Gateway_BNI';
	$methods[] = 'WC_Gateway_BCA';
	$methods[] = 'WC_Gateway_BRI';
	$methods[] = 'WC_Gateway_Mandiri';
	$methods[] = 'WC_Gateway_Jago';
	$methods[] = 'WC_Gateway_CIMB_Niaga';
	$methods[] = 'WC_Gateway_Citibank';
	$methods[] = 'WC_Gateway_Digibank';
	$methods[] = 'WC_Gateway_HSBC';
	$methods[] = 'WC_Gateway_Jenius';
	$methods[] = 'WC_Gateway_Neo_Commerce';
	$methods[] = 'WC_Gateway_Danamon';
	$methods[] = 'WC_Gateway_BTN';
	$methods[] = 'WC_Gateway_BSI';
	$methods[] = 'WC_Gateway_Permata';
	$methods[] = 'WC_Gateway_OCBC_NISP';
	$methods[] = 'WC_Gateway_GoPay';
	$methods[] = 'WC_Gateway_OVO';	
	$methods[] = 'WC_Gateway_Dana';
	$methods[] = 'WC_Gateway_LinkAja';
	
	return $methods;
}