<?php
//FORM FOR THE PLUGIN
add_shortcode( 'mhcard_form', 'mhcard_form_shortcode_fn' );

function mhcard_form_shortcode_fn( $attributes ) {
   
   extract( shortcode_atts(
        array(
            'orderid' => '',
            'returntype' => '',
        ), $attributes)
    );

    /* setup used product codes
    all product codes in version 2.7 */
    $productCodes = array(
        10 => __('Bus parcel', 'mh-osoitekortti'),
        11 => __('Bus parcel (cash)', 'mh-osoitekortti'),
        30 => __('Delivery parcel', 'mh-osoitekortti'),
        34 => __('Home delivery', 'mh-osoitekortti'),
        57 => __('Pallets', 'mh-osoitekortti'),
        70 => __('Export document by flight', 'mh-osoitekortti'),
        71 => __('Export parcel by flight', 'mh-osoitekortti'),
        80 => __('Near Parcel', 'mh-osoitekortti'),
        84 => __('XXS', 'mh-osoitekortti'),
        95 => __('Export Near Parcel', 'mh-osoitekortti'),    
        96 => __('Export Delivery Parcel', 'mh-osoitekortti'),
    );

    $product_options = "";
    //setup string for the form
    foreach ($productCodes as $key => $value) {
        $product_options .= '<option value="' . esc_attr( $key ) . '">' . esc_attr( $value ) . '</option>';
    }

    //make form string
    $passStuff = '
    <form method="POST" action="' . admin_url( 'admin-post.php' ) . '"> 
    ' . wp_nonce_field( "save_mhcard", "save_mhcard_nonce" ) . '

    <label for="Product_Code">' .__('Type of cargo:', 'mh-osoitekortti').'</label><br>
    <select class="form-select" id="Product_Code" name="Product_Code">' .
    $product_options .
    '</select><br>

    <label for="Weight">' .__('Weight:','mh-osoitekortti').'</label><br>
    <input type="text" class="form-text" placeholder="' .__('e.g. 1.23, use dot to separate','mh-osoitekortti'). '" id="Weight" name="Weight"><br>

    <label for="Package_Amount">' .__('Amount of packages','mh-osoitekortti').':</label><br>
    <input type="text" class="form-text" id="Package_Amount" name="Package_Amount"><br>

    <div class="form-field form-checkbox-container"><input type="hidden" value="0" name="SpecialHandling"><input type="checkbox" class="form-checkbox" value="1" id="SpecialHandling" name="SpecialHandling"><label for="SpecialHandling">' .__('Large Shipment', 'mh-osoitekortti'). '</label></div>

    <input type="hidden" name="passOrderId" value="'.esc_attr( $orderid ).'"/>
    <input type="hidden" name="passReturnType" value="'.esc_attr( $returntype ).'"/>
    <input type="hidden" name="action" value="submitform"/>
    <input type="submit"  value="' .__('Send', 'mh-osoitekortti').'" />
    </form>';

    return $passStuff;
}
