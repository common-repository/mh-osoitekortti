<?php
/**
* @package MhOsoitekortti
*/
/*
Plugin Name: Mh Osoitekortti
Plugin URI: https://www.verkkovaraani.fi/palvelut/verkkosivut/wp-mh-osoitekortti/
Description: Luo nappulan WooCommercen tilaussivulle, jolla voit tulostaa matkahuollon osoitekortin ja lähettää asiakkaalle tilauksen tiedot sekä seurantanumeron. Tarkista asetukset ennen käyttöä.
Author: Jani Makkonen / Verkkovaraani
Version: 1.1.3
Author URI: https://www.verkkovaraani.fi
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
*/

//check if woocommerce is active
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if(is_plugin_active( 'woocommerce/woocommerce.php')){
	
	//Get and define plugin dir to variable
	define( 'MHCARD_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

	//include settings
	include(MHCARD_PLUGIN_DIR . '/inc/mhcard-options.php');   

	//include user input form
	include(MHCARD_PLUGIN_DIR . '/inc/mhcard-input-form.php');

	//add button to WooCommerce orders page
	include(MHCARD_PLUGIN_DIR . '/inc/mhcard-add-list-button.php');

	//add button to WooCommerce order edit page
	include(MHCARD_PLUGIN_DIR . '/inc/mhcard-add-edit-button.php');

	//require the class for xml handling
	require_once(MHCARD_PLUGIN_DIR . '/class.mhcard-matkahuolto.php');

	//handle the form submission
	include(MHCARD_PLUGIN_DIR . '/inc/mhcard-form-handle.php');

	add_action( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'mhcard_add_settings_link_to_plugin_links' );
	
}else{
	add_action( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'mhcard_add_error_text_to_plugin_links' );
}

//Shows warning text when WooCommerce is not active
function mhcard_add_error_text_to_plugin_links( $links ) {

	$links = array_merge( array(
		'<font color="red">'.__('Activate Woocommerce to use this plugin.','mh-osoitekortti') .'</font>'
	), $links );

	return $links;

}
//Shows settings link when WooCommerce is active
function mhcard_add_settings_link_to_plugin_links( $links ) {

	$links = array_merge( array(
		'<a href="' . esc_url( admin_url( 'admin.php?page=wc-settings&tab=mhcard_settings_tab' ) ) . '">' . __( 'Settings') . '</a>'
	), $links );

	return $links;

}

//Define plugin name to allow translations
define( 'MHCARD_PLUGIN_NAME', 'mh-osoitekortti');

/*Function to load textdomain for translation */
function plugin_load_textdomain() {
	load_plugin_textdomain( MHCARD_PLUGIN_NAME, false, basename( dirname( __FILE__ ) ) . '/languages/' );
	}
	add_action( 'init', 'plugin_load_textdomain' );


/*Replace {mhcard_shipment_number} placeholder with actualy MH card shipment number in emails*/ 
add_filter( 'woocommerce_email_format_string' , 'mhcard_add_shipment_number_string', 10, 4 );
function mhcard_add_shipment_number_string( $string, $email ) {
    $placeholder = '{mhcard_shipment_number}'; // The corresponding placeholder to be used
    $order = $email->object; // Get the instance of the WC_Order Object
	$value = "";
	if (isset(get_post_meta($order->get_id(), 'mhcard_shipment_number')[0]))
   		$value =get_post_meta($order->get_id(), 'mhcard_shipment_number')[0];
    // Return the clean replacement value string for "{delivery_date}" placeholder
    return str_replace( $placeholder, $value, $string );
}
	

