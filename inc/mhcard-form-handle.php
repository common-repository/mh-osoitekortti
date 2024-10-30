<?php

add_action( 'admin_post_submitform', 'mhcard_submit_form', 100);

//sets wp_mail content type to text/html
function mhcard_set_wp_mail_to_html() {
    return 'text/html';
}


function mhcard_submit_form(){
        
    if( current_user_can( 'edit_others_shop_orders' ) ){
        $dataError = array();
        //check the nonce
        if ( !isset( $_POST['save_mhcard_nonce'] ) &&
            !wp_verify_nonce( $_POST['save_mhcard_nonce'], 'save_mhcard' ) ) {
            wp_die(__('Nonce does not match.', 'mh-osoitekortti'), __('Nonce does not match.', 'mh-osoitekortti'), array(
                        'back_link' => ''));
        }

        //loads order object to get data   
        $order = wc_get_order( sanitize_text_field( $_POST['passOrderId'] ) );

        //Set the redirect url here. Depends on the page where the save button was clicked
        global $wp;
        $returnType = sanitize_text_field( $_POST['passReturnType'] ); 
        if($returnType == 'list'){
            $redirectUrl = admin_url() . '/edit.php?post_type=shop_order';

        }else{
            $redirectUrl = admin_url() . '/post.php?post=' . $order->get_id() .'&action=edit';

        }

        if(empty($_POST['Package_Amount'])){
            $dataError[__('Package amount', 'mh-osoitekortti')] = true;
        }

        //Get data from the form
        $weight = sanitize_text_field( $_POST['Weight'] );
        $packages = sanitize_text_field( $_POST['Package_Amount'] );
        $productCode = sanitize_text_field( $_POST['Product_Code'] );
        $specialHandling = sanitize_text_field( $_POST['SpecialHandling'] );
        $message_type = "N";
        $shipment_type = "N";


        //Get data from the order object
        $receiver_name = sanitize_text_field($order->get_shipping_first_name() . ' ' . $order->get_shipping_last_name());
        if(empty($receiver_name)){
            $receiver_name = sanitize_text_field($order->get_billing_first_name() . ' ' . $order->get_billing_last_name());
        }

        if(!empty($order->get_shipping_address_1())){
            $receiver_address = sanitize_text_field( $order->get_shipping_address_1() );
        }else{
            $receiver_address = sanitize_text_field( $order->get_billing_address_1() );
        }
        if(!empty($order->get_shipping_postcode())){
            $receiver_postal = sanitize_text_field( $order->get_shipping_postcode() );
        }else{
            $receiver_postal = sanitize_text_field( $order->get_billing_postcode() ); 
        }
        if (!is_numeric($receiver_postal)) {
            wp_die(__('Recipients postcode field can only consist of numbers.','mh-osoitekortti'), __('Recipients postcode field can only consist of numbers.', 'mh-osoitekortti'), array(
                        'back_link' => $redirectUrl));
        }
        if(!empty($order->get_shipping_city())){
            $receiver_city = sanitize_text_field( $order->get_shipping_city() );
        }else{
            $receiver_city = sanitize_text_field( $order->get_billing_city() );
        }
        $receiver_number = sanitize_text_field( $order->get_billing_phone() );
        if(!empty($receiver_number)){
            if (!is_numeric($receiver_number)) {
                wp_die(__('Recipients phone number field can only consist of numbers.','mh-osoitekortti'), __('Recipients phone number field can only consist of numbers.','mh-osoitekortti'), array(
                        'back_link' => $redirectUrl));
            }       
        }
        $receiver_email = sanitize_text_field( $order->get_billing_email() );

        if(empty($receiver_name)){
            $dataError['Vastanottajan nimi'] = true;
        }
        if(empty($receiver_postal)){
            $dataError['Vastaanottajan postinumero'] = true;
        }
        if(empty($receiver_city)){
            $dataError['Vastaanottajan paikkakunta'] = true;
        }


        $order_sum = sanitize_text_field( $order->get_total() );

        //Get data from the plugin options
        $useMode = sanitize_text_field( get_option('mhcard_settings_mode') );

        //user account data
        $user_id = sanitize_text_field( get_option('mhcard_settings_customer_number') );
        $senderId = sanitize_text_field( get_option('mhcard_settings_sender_id') );
        $password = sanitize_text_field( get_option('mhcard_settings_password') );

        //user information
        $sender_name = sanitize_text_field( get_option('mhcard_settings_sender_name') );
        $sender_address = sanitize_text_field( get_option('mhcard_settings_sender_address') );
        $sender_postal_number = sanitize_text_field( get_option('mhcard_settings_sender_postal_number') );
        if(!empty($sender_postal_number)){
            if (!is_numeric($sender_postal_number)) {
                wp_die(__('Senders postcode field can only consist of numbers.','mh-osoitekortti'), 'Lähettäjän postinumerokentässä voi olla vain numeroita.', array(
                        'back_link' => $redirectUrl));
            }       
        }
        $sender_city = sanitize_text_field( get_option('mhcard_settings_sender_city') );
        $sender_email = sanitize_text_field( get_option('mhcard_settings_sender_email') );
        $sender_phone_number = sanitize_text_field( get_option('mhcard_settings_sender_phone_number') );
        $sender_email_checkbox = sanitize_text_field( get_option('mhcard_settings_sender_email_checkbox') );
        if(!empty($sender_phone_number)){
            if (!is_numeric($sender_phone_number)) {
                wp_die(__('Senders phone number field can only consist of numbers.','mh-osoitekortti') , 'Lähettäjän puhelinnumerokentässä voi olla vain numeroita.', array(
                        'back_link' => $redirectUrl));
            }       
        }


        $mh = new MHCARD_Matkahuolto();
           
        if($useMode == 'test'){
            $url = 'https://extservicestest.matkahuolto.fi/mpaketti/mhshipmentxml';
        }else{
            $url = 'https://extservices.matkahuolto.fi/mpaketti/mhshipmentxml'; 
        } 

        $version = '2.7';
        
        //Set Matkahuolto settings
        $mh->pUserId($user_id);
        $mh->Password($password);
        $mh->Version($version);

        $mh->ShipmentType($shipment_type);

        $mh->MessageType($message_type);
        $mh->Weight($weight);
        $mh->Packages($packages);
        $mh->SenderId($senderId);
        $mh->ReceiverName1($receiver_name);
        $mh->ReceiverAddress($receiver_address);
        $mh->ReceiverPostal($receiver_postal);
        $mh->ReceiverCity($receiver_city);
        $mh->ReceiverContactNumber($receiver_number);
        $mh->ReceiverEmail($receiver_email);
        $mh->ProductCode($productCode);
        if($specialHandling == 1){
            $mh->SpecialHandling('K02');
        }

        $mh->SenderName1($sender_name);
        $mh->SenderAddress($sender_address);
        $mh->SenderPostal($sender_postal_number);
        $mh->SenderCity($sender_city);
        $mh->SenderContactNumber($sender_phone_number);
        $mh->SenderEmail($sender_email);
        

        if(!$dataError){
            //sends the xml message
            $mh->mhcard_sendXML($url);
        }else{
            $dieString = __('"Missing <b>mandatory</b> fields:<br>"', 'mh-osoitekortti');
            foreach ($dataError as $key => $value) {
                $dieString .= "<b>" . esc_html( $key ) . "</b><br>";
            }
             wp_die($dieString, __('All required fields have not been filled.', 'mh-osoitekortti'), array(
                'back_link' => $redirectUrl));     
        }


        /* if no errors create pdf-file */
        if ($mh->ErrorNbr == ""){
            //saves the email message to variable
            $html = require 'mhcard-product-shop-mail.php';
            
            //gets address to the uploads folder
            $uploadDir = wp_upload_dir();
            
            //save file url to variable
            $file = $uploadDir['baseurl'] . '/mhcard_address_cards/' . $mh->ShipmentNumber .'.pdf';

            // The text for the note
            $note = __(__('Created a Matkahuolto shipment.', 'mh-osoitekortti') . "  $mh->ShipmentNumber<br>"
             . esc_html( $weight ). "kg - " . esc_html( $packages ) . __('pcs','mh-osoitekortti').".", '<br>'
             . '<a href="' . $file  .'" download>' .__('Download address card', 'mh-osoitekortti') .'</a>'); 
        
            //set email variables
            $to = $receiver_email;
            $subject = __('Matkahuolto shipment - order number #', 'mh-osoitekortti') . $order->get_id();
            $headers = array('From: ' . $mh->SenderName1 . ' <' . $mh->SenderEmail . '>');
            $message = $html;

            //this hook sets wp_mail content type to text/html
            add_filter( 'wp_mail_content_type', 'mhcard_set_wp_mail_to_html' );


            $mailNote = "";
            //sends the email to the customer
            if ($sender_email_checkbox == 'yes') {
            $mailSuccess = wp_mail( $to, $subject, $message, $headers );

            if ($mailSuccess) {
            $mailNote = " " .__('and sent email to the customer.', 'mh-osoitekortti'). "";
            }
            else {
                $mailNote = " " .__(', but failed to send email.', 'mh-osoitekortti'). "";
            }
        }
            $note = $note.$mailNote;
            // Adds the note
            $order->add_order_note( $note );    
            
            //remove the filter after sending mail
            remove_filter( 'wp_mail_content_type', 'mhcard_set_wp_mail_to_html' );

            //saves pdf file to the uploads folder
            $mh->mhcard_savePDF($mh->ShipmentPdf);

            //saves shipmentnumber to the post meta
            if(get_post_meta($order->get_id(), 'mhcard_shipment_number')[0]){
                delete_post_meta($order->get_id(), 'mhcard_shipment_number');
            }
            add_post_meta( $order->get_id(), 'mhcard_shipment_number', $mh->ShipmentNumber );

            wp_redirect( $redirectUrl );  

            $reloadMain = true;
        }else{
            $error = $mh->ErrorMsg;
            $customErrorMessage = $error;
            if($error == 'Authorization failed'){
                $customErrorMessage = "" .__('Error in login information. Check in the plugin settings that all required fields are filled.','mh-osoitekortti'). "";    
            }
            wp_die($customErrorMessage, __('Error','mh-osoitekortti'), array(
                        'back_link' => $redirectUrl)); 
        }

        return $value;
    }
    
}