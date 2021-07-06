<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) { 
    exit; // Exit if accessed directly
}

/**
 * @package   iBestPay - Bank dan e-Money Indonesia
 * @author    Reynaldi Arya
 * @category  Checkout Page
 * @copyright Copyright (c) 2021
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 **/

/**
 * Add an option on Advanced tab setting panel
 **/

add_filter( 'woocommerce_get_sections_advanced', 'pcpgw_add_section' );
function pcpgw_add_section( $sections ) {
	
	$sections['paymentcode'] = __( 'Kode Pembayaran', 'pcpgw' );
	return $sections;	
}

/**
 * Add settings to the specific section we created before
 */

add_filter( 'woocommerce_get_settings_advanced', 'paymentcode_all_settings', 10, 2 );
function paymentcode_all_settings( $settings, $current_section ) {
	
	/**
	 * Check the current section is what we want
	 **/

	if ( $current_section == 'paymentcode' ) {
		$settings_paymentcode = array();
		// Add Title to the Settings
		$settings_paymentcode[] = array(
			'name' => __( 'Tambahkan Kode Pembayaran Unik', 'pcpgw' ),
			'type' => 'title',
			'desc' => __( 'Untuk dengan mudah mengonfirmasi pembayaran yang dilakukan oleh pelanggan Anda, Anda dapat menambahkan kode pembayaran 3 digit, yang dibuat secara otomatis, di halaman pembayaran Anda. Jika diaktifkan, kode 3 digit akan meningkatkan total pembayaran.', 'pcpgw' ),
			'id'   => 'paymentcode',
		);
		// Build Text field option
		$settings_paymentcode[] = array(
			'type'     => 'checkbox',
			'id'       => 'woocommerce_paymentcode_enabled',
			'name'     => __( 'Enable / Disable', 'pcpgw' ),
			'desc'     => __( 'Aktifkan Kode Pembayaran', 'pcpgw' ),
			'desc_tip'     => __( 'Anda dapat memilih untuk mengaktifkan atau menonaktifkan kode pembayaran unik kapan saja.', 'pcpgw' ),
			'default'  => 'no',
		);

		$settings_paymentcode[] = array(
			'name'     => __( 'Judul Kode Pembayaran', 'pcpgw' ),
			'desc'     => __( '<br />Ubah judul default untuk opsi Kode Pembayaran', 'pcpgw' ),
			'id'       => 'woocommerce_payment_code_title',
			'type'     => 'text',
			'placeholder'   => 'Kode Pembayaran',
		);		
		
		$settings_paymentcode[] = array( 'type' => 'sectionend', 'id' => 'paymentcode' );
		return $settings_paymentcode;
		
	/**
	 * If not, return the standard settings
	 **/
} else {
	return $settings;
}
}

/**
 * Register Payment Code Function
 * 
 * To easily identify customers' payments
 *
 * @return void
 */
if ( 'yes' == get_option( 'woocommerce_paymentcode_enabled' ) ) {	
	add_action( 'woocommerce_cart_calculate_fees', 'add_payment_code' );
	function add_payment_code(){
		global $woocommerce;

$enable = 1;  
$title = '';
    	if(get_option( 'woocommerce_payment_code_title' )){
        	$title = (get_option( 'woocommerce_payment_code_title' ));
    }
    	else {
        	$title = __( 'Kode Pembayaran', 'pcpgw' );
    }

		if ( $enable == 1 && $woocommerce->cart->subtotal != 0){
			if(! is_cart()){
				$cost = rand(100, 999);

				if($cost != 0)
					$woocommerce->cart->add_fee( __($title, 'woocommerce'), $cost);
			}
		}
	}
}