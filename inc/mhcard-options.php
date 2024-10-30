<?php


//This file creates a settings tab under WooCommerce settings

add_filter( 'woocommerce_settings_tabs_array', 'mhcard_add_settings_tab', 50 );

function mhcard_add_settings_tab( $settings_tabs ) {
    $settings_tabs['mhcard_settings_tab'] = __( 'Mh Address card','mh-osoitekortti', 'woocommerce-settings-mhcard_tab' );
    return $settings_tabs;
}

add_action( 'woocommerce_settings_tabs_mhcard_settings_tab', 'mhcard_settings_tab' );

function mhcard_settings_tab() {
    woocommerce_admin_fields( mhcard_get_settings() );
}

function mhcard_get_settings() {

    $settings = array(
        'login_section_title' => array(
            'name'     => __( 'Log in', 'mh-osoitekortti'),
            'type'     => 'title',
            'desc'     => sprintf(__('Required fields are marked %s'), '<span class="required">*</span>'),
            'id'       => 'mhcard_settings_login_section_title'
        ),
        'mhcard_settings_mode' => array(
            'name' => __( 'Mode','mh-osoitekortti'),
            'type' => 'select',
            'options' => array('test' => __('Test', 'mh-osoitekortti'), 'production' => __('Production', 'mh-osoitekortti')),
            'id'   => 'mhcard_settings_mode'
        ),
        'mhcard_settings_sender_id' => array(
            'name' => __( 'Login Name', 'mh-osoitekortti').' *',      
            'type' => 'text',
            'custom_attributes' => array( 'required' => 'required' ),
            'id'   => 'mhcard_settings_sender_id'
        ),
        'mhcard_settings_password' => array(
            'name' => __( 'Password', 'mh-osoitekortti').' *',
            'type' => 'text',
            'custom_attributes' => array( 'required' => 'required' ),
            'id'   => 'mhcard_settings_password'
        ),
        'section_end' => array(
            'type' => 'sectionend',
            'id' => 'mhcard_settings_login_section_end'
       ),
       'sender_section_title' => array(
           'name'  => __( 'Sender information', 'mh-osoitekortti'),
           'type'  => 'title',
           'desc'  => '',
           'id'    => 'mhcard_settings_sender_section_title'
       ),
       'mhcard_settings_customer_number' => array(
           'name' => __( 'Mh customer number', 'mh-osoitekortti').' *',
           'type' => 'text',
           'custom_attributes' => array( 'required' => 'required' ),
           'id'   => 'mhcard_settings_customer_number'
       ),
       'mhcard_settings_sender_name' => array(
           'name' => __( 'Name', 'mh-osoitekortti'),
           'type' => 'text',
           'id'   => 'mhcard_settings_sender_name'
       ),
       'mhcard_settings_sender_address' => array(
           'name' => __( 'Address', 'mh-osoitekortti'),
           'type' => 'text',
           'id'   => 'mhcard_settings_sender_address'
       ),
       'mhcard_settings_sender_postal_number' => array(
           'name' => __( 'Postcode', 'mh-osoitekortti' ),
           'type' => 'text',
           'id'   => 'mhcard_settings_sender_postal_number'
       ),
       'mhcard_settings_sender_city' => array(
           'name' => __( 'City', 'mh-osoitekortti'),
           'type' => 'text',
           'id'   => 'mhcard_settings_sender_city'
       ),
       'mhcard_settings_sender_phone_number' => array(
           'name' => __( 'Phone', 'mh-osoitekortti'),
           'type' => 'text',
           'id'   => 'mhcard_settings_sender_phone_number'
       ),  
       'mhcard_settings_sender_email' => array(
           'name' => __( 'Email', 'mh-osoitekortti'),
           'type' => 'text',
           'id'   => 'mhcard_settings_sender_email'
       ),
       'section_end_2' => array(
            'type' => 'sectionend',
            'id' => 'mhcard_settings_sender_section_end'
       ),
       'information_settings_title' => array(
           'name'     => __( 'Email sending', 'mh-osoitekortti'),
           'type'     => 'title',
           'desc'     => __('To send shipment number in Woocommerce emails, use placeholder {mhcard_shipment_number}. Or send automatically by checking the checkbox below.', 'mh-osoitekortti'),
           'id'       => 'mhcard_settings_title'
       ),
       'mhcard_settings_sender_email_checkbox' => array(
           'name' => __('Email sending', 'mh-osoitekortti'),
           'type' => 'checkbox',
           'desc' => __('Send email when creating a new shipment card with shipment number', 'mh-osoitekortti'),
           'id'   => 'mhcard_settings_sender_email_checkbox'
       ),
       'section_end_3' => array(
           'type' => 'sectionend',
           'id' => 'mhcard_settings_sender_section_end'
       ),
   );
   return apply_filters( 'wc_mhcard_settings_tab_settings', $settings );
}

add_action( 'woocommerce_update_options_mhcard_settings_tab', 'update_mhcard_settings' );

function update_mhcard_settings() {
    woocommerce_update_options( mhcard_get_settings() );
}