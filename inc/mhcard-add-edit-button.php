<?php

// adds new button for woocommerce edit order page

add_action( 'woocommerce_admin_order_data_after_shipping_address', 'mhcard_action_woocommerce_order_item_add_action_buttons', 10, 1);



function mhcard_action_woocommerce_order_item_add_action_buttons( $order )

{

        ?>
        <div style="text-align:left;padding:20px 0;"> 
            
            <?php if(isset(get_post_meta($order->get_id(), 'mhcard_shipment_number')[0])){
                    $uploadDir = wp_upload_dir();
                    $file = $uploadDir['baseurl'] . '/mhcard_address_cards/' . sanitize_text_field( get_post_meta($order->get_id(), 'mhcard_shipment_number')[0] ) .'.pdf';
                    echo '<a class="button action" href="' . esc_url( $file ) .'" download>' .__('Download ','mh-osoitekortti') . sanitize_text_field( get_post_meta($order->get_id(), 'mhcard_shipment_number')[0] ) . '</a>'?>
                <?php }else{ ?> 
                    <input alt="#TB_inline?height=300&amp;width=300&amp;inlineId=mhCardPopup<?php echo ""; ?>" title="" class="thickbox button action" type="button" value="<?= __('Save new address card and send information','mh-osoitekortti' ); ?>" /> 
                <?php }?>  
        </div>
         <div id="mhCardPopup<?php echo ""; ?>" style="display:none"> 
         <h2><?php echo __('Create Matkahuolto-address label', 'mh-osoitekortti' ); ?></h2>
            <form>
            </form>
                <?php echo do_shortcode( '[mhcard_form orderid=' . $order->get_id()  . ' returntype=edit]' ) ?> 
      
        </div>        
        <?php
}
