<?php

//Adds new column for the button
function mhcard_add_button_column_header( $columns ) {

    $new_columns = array();

    foreach ( $columns as $column_name => $column_info ) {

        $new_columns[ $column_name ] = $column_info;

        if ( 'order_status' === $column_name ) {
            $new_columns['mhcard_button_column'] = __( 'Address card', 'mh-osoitekortti' );
        }
    }

    return $new_columns;
}
add_filter( 'manage_edit-shop_order_columns', 'mhcard_add_button_column_header', 20 );


//Adds the button to the column
add_action( 'manage_shop_order_posts_custom_column' , 'mhcard_add_button_column_contents', 10, 2 );
function mhcard_add_button_column_contents( $column, $post_id ) {
    if ( 'mhcard_button_column' === $column )
    {
        ?>
        <div style="text-align:left;padding:20px 0;">            
                
                <?php if(isset(get_post_meta($post_id, 'mhcard_shipment_number')[0])){
                    $uploadDir = wp_upload_dir();
                    $file = $uploadDir['baseurl'] . '/mhcard_address_cards/' . sanitize_text_field( get_post_meta($post_id, 'mhcard_shipment_number')[0] ) .'.pdf';
                    echo '<a class="button action" href="' . esc_url( $file ) .'" download>' .__('Download ','mh-osoitekortti') . sanitize_text_field( get_post_meta($post_id, 'mhcard_shipment_number')[0] ). '</a>'?>
                <?php }else{?>
                        <input alt="#TB_inline?height=300&amp;width=300&amp;inlineId=mhCardPopup<?php echo $post_id; ?>" title="" class="thickbox button action" type="button" value="<?= __('Save new address card and send information','mh-osoitekortti' ); ?>" />    
                <?php }?>  
        </div>
        <div id="mhCardPopup<?php echo $post_id; ?>" style="display:none">
            <h2><?php echo __('Create Matkahuolto-address label', 'mh-osoitekortti' ); ?></h2>
            <form>
            </form>
                <?php echo do_shortcode( '[mhcard_form orderid=' . $post_id  . ' returntype=list]' ) ?> 
      
        </div>        
        <?php
    }
}

//Adds CSS styling for the button
add_action( 'admin_head', 'mhcard_add_custom_action_button_css' );
function mhcard_add_custom_action_button_css() {
    $action_slug = "ups";

    echo '<style>.wc-action-button-'.$action_slug.'::after { font-family: woocommerce !important; content: "\e029" !important; }</style>';
}

//loads thickbox
add_action('init', 'mhcard_init_popup');
 
function mhcard_init_popup() {
   add_thickbox();
}

