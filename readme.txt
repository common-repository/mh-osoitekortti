 === Mh Osoitekortti ===
Contributors: verkkovaraani
Tags: woocommerce, matkahuolto, osoitekortti
Requires at least: 5.2.0
Tested up to: 6.0
WC tested up to: 6.4.1
Requires PHP: 7.0
Stable tag: 1.1.3
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Matkahuolto address card addon for WooCommerce.

== Description ==

Mh Osoitekortti is a simple plugin which adds a possibility to create Matkahuolto address cards for WooCommerce orders. The plugin creates a button on both order list page and order edit page. The button allows the user to send order information and a tracking number to customer. Additionally a Matkahuolto address card is created and it can be downloaded with a press of a button.
With the {mhcard_shipment_number} label in the Woocommerce email settings tab, the user can send the Matkahuolto shipment number via Woocommerce email to order recipient.
 - In Woocommerce settings, choose the 'email' tab, choose the email notification you wish to send to the recipient and write {mh_shipment_number} inside the content or subject text fields, this will add the MH shipment number into the email. Please note that the mh card shipment number has to be created by admin before it can be sent to the customer. Recommended Woocommerce emails to use this in are: "Customer Note", and "Completed Order".
 - If you choose to use this {mhcard_shipment_number} option, it is recommended to turn off the automatic email sending option if enabled within the MH Osoitekortti tab in the settings, to avoid sending multiple emails of the same subject. 
 - Admin needs WooCommerce capability edit_others_shop_orders to create cards. Shop manager role has this capability.

== Installation ==

1. Upload or extract the `mh-osoitekortti` folder to your site's `/wp-content/plugins/` directory. You can also use the *Add new- option found in the *Plugins- menu in WordPress.
2. Enable the plugin from the *Plugins- menu in WordPress.
3. Set up your user information on the settings page.

== Screenshots ==

1. Mh Osoitekortti settings page
2. WooCommerce order list with added buttons
3. WooCommerce order edit page with added button
