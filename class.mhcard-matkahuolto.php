<?php

/* Matkahuolto class ***********************************************************************/

class MHCARD_Matkahuolto
{
    /*function __construct()
    {
    // Not needed because we checked the function values existed
     init values as empty strings 
    
    $a = array('pUserId','Password','Version', 'ShipmentType','MessageType','ShipmentNumber','ShipmentDate','Weight','Volume','Packages','SenderId','SenderName1','SenderName2','SenderAddress','SenderPostal','SenderCity','SenderContactName','SenderContactNumber','SenderEmail','SenderReference','DeparturePlaceCode','DeparturePlaceName','ReceiverId','ReceiverName1','ReceiverName2','ReceiverAddress','ReceiverPostal','ReceiverCity','ReceiverContactName','ReceiverContactNumber','ReceiverEmail','ReceiverReference','DestinationPlaceCode','DestinationPlaceName','PayerCode','Remarks','ProductCode','ProductName','Pickup','PickupPayer','PickupRemarks','Delivery','DeliveryPayer','DeliveryRemarks','CODSum','CODCurrency','CODAccount','CODBic','CODReference','VAKCode','VAKDescription','DocumentType','Goods','PdfName','ShipmentPdf','ErrorNbr','ErrorMsg', 'SpecialHandling');
    //$ai = implode(",", $a); //convert array to string

    foreach ($a as $i) 
        $this->{$i}("");
    

    }*/
    
     /* Send message values */
        
    function pUserId($x){$this->pUserId = $x;}
    function Password($x){$this->Password = $x;}  
    function Version($x){$this->Version = $x;}  
    function MessageType($x){$this->MessageType = $x;}  
    function ShipmentNumber($x){$this->ShipmentNumber = $x;}  
    function ShipmentDate($x){$this->ShipmentDate = $x;}
    function ShipmentType($x){$this->ShipmentType = $x;}    
    function Weight($x){$this->Weight = $x;} 
    function Volume($x){$this->Volume = $x;} 
    function Packages($x){$this->Packages = $x;} 
    function SenderId($x){$this->SenderId = $x;} 
    function SenderName1($x){$this->SenderName1 = $x;} 
    function SenderName2($x){$this->SenderName2 = $x;} 
    function SenderAddress($x){$this->SenderAddress = $x;} 
    function SenderPostal($x){$this->SenderPostal = $x;} 
    function SenderCity($x){$this->SenderCity = $x;} 
    function SenderContactName($x){$this->SenderContactName = $x;}
    function SenderContactNumber($x){$this->SenderContactNumber = $x;}  
    function SenderEmail($x){$this->SenderEmail = $x;} 
    function SenderReference($x){$this->SenderReference = $x;} 
    function DeparturePlaceCode($x){$this->DeparturePlaceCode = $x;} 
    function DeparturePlaceName($x){$this->DeparturePlaceName = $x;}
    function ReceiverId($x){$this->ReceiverId = $x;}
    function ReceiverName1($x){$this->ReceiverName1 = $x;} 
    function ReceiverName2($x){$this->ReceiverName2 = $x;} 
    function ReceiverAddress($x){$this->ReceiverAddress = $x;} 
    function ReceiverPostal($x){$this->ReceiverPostal = $x;} 
    function ReceiverCity($x){$this->ReceiverCity = $x;} 
    function ReceiverContactName($x){$this->ReceiverContactName = $x;} 
    function ReceiverContactNumber($x){$this->ReceiverContactNumber = $x;} 
    function ReceiverEmail($x){$this->ReceiverEmail = $x;} 
    function ReceiverReference($x){$this->ReceiverReference = $x;} 
    function DestinationPlaceCode($x){$this->DestinationPlaceCode = $x;} 
    function DestinationPlaceName($x){$this->DestinationPlaceName = $x;} 
    function PayerCode($x){$this->PayerCode = $x;} 
    function Remarks($x){$this->Remarks = $x;} 
    function ProductCode($x){$this->ProductCode = $x;} 
    function ProductName($x){$this->ProductName = $x;} 
    function Pickup($x){$this->Pickup = $x;} 
    function PickupPayer($x){$this->PickupPayer = $x;} 
    function PickupRemarks($x){$this->PickupRemarks = $x;} 
    function Delivery($x){$this->Delivery = $x;} 
    function DeliveryPayer($x){$this->DeliveryPayer = $x;} 
    function DeliveryRemarks($x){$this->DeliveryRemarks = $x;} 
    function CODSum($x){$this->CODSum = $x;} 
    function CODCurrency($x){$this->CODCurrency = $x;} 
    function CODAccount($x){$this->CODAccount = $x;}
    function CODBic($x){$this->CODBic = $x;} 
    function CODReference($x){$this->CODReference = $x;} 
    function Goods($x){$this->Goods = $x;} 
    function VAKCode($x){$this->VAKCode = $x;} 
    function VAKDescription($x){$this->VAKDescription = $x;} 
    function DocumentType($x){$this->DocumentType = $x;} 
    function SpecialHandling($x){$this->SpecialHandling = $x;} 
        
    /* Succeful return message values */    
        
    function PdfName($x){$this->PdfName = $x;} 
    function ShipmentPdf($x){$this->ShipmentPdf = $x;} 
    
     /* Error message values */
    
    function ErrorNbr($x){$this->ErrorNbr = $x;} 
    function ErrorMsg($x){$this->ErrorMsg = $x;} 
        
    public function mhcard_sendXML($url)
    {
    /* Create XML-document for sending */
 
            $xml = new XMLWriter();
            $xml->openMemory(); 
            $xml->startDocument('1.0'); 
            $xml->startElement('MHShipmentRequest');
            
            $xml->writeElement('pUserId', $this->pUserId);
            $xml->writeElement('Password', $this->Password);
            $xml->writeElement('Version', $this->Version); 
            
            $xml->startElement('Shipment');

            if(isset($this->ShipmentType)) $xml->writeElement('ShipmentType', $this->ShipmentType);
     
            $xml->writeElement('MessageType', $this->MessageType);
            if (isset($this->ShipmentNumber)) $xml->writeElement('ShipmentNumber', $this->ShipmentNumber);
            if (isset($this->ShipmentDate)) $xml->writeElement('ShipmentDate', $this->ShipmentDate);
            $xml->writeElement('Weight', $this->Weight);
            if (isset($this->Volume)) $xml->writeElement('Volume', $this->Volume);
            $xml->writeElement('Packages', $this->Packages);
            $xml->writeElement('SenderId', $this->SenderId);
            $xml->writeElement('SenderName1', $this->SenderName1);
            if (isset($this->SenderName2)) $xml->writeElement('SenderName2', $this->SenderName2);
            $xml->writeElement('SenderAddress', $this->SenderAddress);
            $xml->writeElement('SenderPostal', $this->SenderPostal);
            $xml->writeElement('SenderCity', $this->SenderCity);
            if (isset($this->SenderContactName)) $xml->writeElement('SenderContactName', $this->SenderContactName);
            $xml->writeElement('SenderContactNumber', $this->SenderContactNumber);
            $xml->writeElement('SenderEmail', $this->SenderEmail);
            if (isset($this->SenderReference)) $xml->writeElement('SenderReference', $this->SenderReference);
            if (isset($this->DeparturePlaceCode)) $xml->writeElement('DeparturePlaceCode', $this->DeparturePlaceCode);
            if (isset($this->DeparturePlaceName)) $xml->writeElement('DeparturePlaceName', $this->DeparturePlaceName);
            if (isset($this->ReceiverId)) $xml->writeElement('ReceiverId', $this->ReceiverId);
            $xml->writeElement('ReceiverName1', $this->ReceiverName1);
            if (isset($this->ReceiverName2)) $xml->writeElement('ReceiverName2', $this->ReceiverName2);
            $xml->writeElement('ReceiverAddress', $this->ReceiverAddress);
            $xml->writeElement('ReceiverPostal', $this->ReceiverPostal);
            $xml->writeElement('ReceiverCity', $this->ReceiverCity);
            if (isset($this->ReceiverContactName)) $xml->writeElement('ReceiverContactName', $this->ReceiverContactName);
            $xml->writeElement('ReceiverContactNumber', $this->ReceiverContactNumber);
            $xml->writeElement('ReceiverEmail', $this->ReceiverEmail);
            if (isset($this->ReceiverReference)) $xml->writeElement('ReceiverReference', $this->ReceiverReference);
            if (isset($this->DestinationPlaceCode)) $xml->writeElement('DestinationPlaceCode', $this->DestinationPlaceCode);
            if (isset($this->DestinationPlaceName)) $xml->writeElement('DestinationPlaceName', $this->DestinationPlaceName);
            if (isset($this->PayerCode)) $xml->writeElement('PayerCode', $this->PayerCode);
            if (isset($this->Remarks)) $xml->writeElement('Remarks', $this->Remarks);
            $xml->writeElement('ProductCode', $this->ProductCode);
            if (isset($this->ProductName)) $xml->writeElement('ProductName', $this->ProductName);
            if (isset($this->Pickup)) $xml->writeElement('Pickup', $this->Pickup);
            if (isset($this->PickupPayer)) $xml->writeElement('PickupPayer', $this->PickupPayer);
            if (isset($this->PickupRemarks)) $xml->writeElement('PickupRemarks', $this->PickupRemarks);
            if (isset($this->Delivery)) $xml->writeElement('Delivery', $this->Delivery);
            if (isset($this->DeliveryPayer)) $xml->writeElement('DeliveryPayer', $this->DeliveryPayer);
            if (isset($this->DeliveryRemarks)) $xml->writeElement('DeliveryRemarks', $this->DeliveryRemarks);
            if (isset($this->CODSum)) $xml->writeElement('CODSum', $this->CODSum);
            if (isset($this->CODCurrency)) $xml->writeElement('CODCurrency', $this->CODCurrency);
            if (isset($this->CODAccount)) $xml->writeElement('CODAccount', $this->CODAccount);
            if (isset($this->CODBic)) $xml->writeElement('CODBic', $this->CODBic);
            if (isset($this->CODReference)) $xml->writeElement('CODReference', $this->CODReference);
            if (isset($this->Goods)) $xml->writeElement('Goods', $this->Goods);
            if (isset($this->VAKCode)) $xml->writeElement('VAKCode', $this->VAKCode);
            if (isset($this->VAKDescription)) $xml->writeElement('VAKDescription', $this->VAKDescription);
            if (isset($this->DocumentType)) $xml->writeElement('DocumentType', $this->DocumentType);
            if (isset($this->SpecialHandling)) $xml->writeElement('SpecialHandling', $this->SpecialHandling);
        
            $xml->endElement();
      
            $xml->endElement();
            define('MHCARD_SENDXML', $xml->flush());
            $xml->endDocument();    

             /* Send the XML */

            $res = wp_remote_post( 
                $url, 
                array(
                    'method' => 'POST',
                    'timeout' => 45,
                    'redirection' => 5,
                    'httpversion' => '1.0',
                    'headers' => array(
                    'Content-Type' => 'application/xml'
                ),
                'body' => MHCARD_SENDXML,
                'sslverify' => false
            )
            );

    /* Receive return message
        this checks if the request was succesfu*/
    if( 200 <= $res['response']['code'] && 299 >= $res['response']['code'] ){
        $reader = new XMLReader();
        $reader->XML(wp_remote_retrieve_body($res));
        
         while ($reader->read()) {
   
            if($reader->nodeType == 1)
            {
                 /* Set the return message values */
                 
                switch ($reader->name)
                {
                 case "ShipmentNumber":
                    $reader->read();
                    $this->ShipmentNumber($reader->value);
                    break;
                 case "SenderReference":
                    $reader->read();
                    $this->SenderReference($reader->value);
                    break;    
                 case "ShipmentPdf":
                    $reader->read();
                    $this->ShipmentPdf($reader->value);
                    break;    
                 case "PdfName":
                    $reader->read();
                    $this->PdfName($reader->value);
                    break; 
                 case "ErrorNbr":
                    $reader->read();
                    $this->ErrorNbr($reader->value);
                    break;   
                 case "ErrorMsg":
                    $reader->read();
                    $this->ErrorMsg($reader->value);
                    break;      
                }
            }
         }
       }
    }

    public function mhcard_savePDF($pdf){
        //create folder for made address cards if it does not exist
        if(!file_exists(WP_CONTENT_DIR . '/uploads/mhcard_address_cards')){
            mkdir(WP_CONTENT_DIR . '/uploads/mhcard_address_cards');
        }

        /* CREATE PDF FILE SAVE AND SHOW IT */
        $filebytes = base64_decode($pdf);

        $file = WP_CONTENT_DIR . '/uploads/mhcard_address_cards/' . $this->ShipmentNumber .'.pdf';
        file_put_contents($file, $filebytes);
    }

    public function mhcard_showPDF($mhNumber){
        //create folder for made address cards if it does not exist
        if(!file_exists(WP_CONTENT_DIR . '/uploads/mhcard_address_cards')){
            mkdir(WP_CONTENT_DIR . '/uploads/mhcard_address_cards');
        }

        $file = WP_CONTENT_DIR . '/uploads/mhcard_address_cards/' . $mhNumber .'.pdf';

        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($file).'"');
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            ob_clean();
            flush();
            readfile($file);
        }else{
            echo __('NO FILE','mh-osoitekortti');
        }
        exit;   
    }

    public function mhcard_saveAndShowPDF($pdf){
        //create folder for made address cards if it does not exist
        if(!file_exists(WP_CONTENT_DIR . '/uploads/mhcard_address_cards')){
            mkdir(WP_CONTENT_DIR . '/uploads/mhcard_address_cards');
        }

        /* CREATE PDF FILE SAVE AND SHOW IT */
        $filebytes = base64_decode($pdf);

        $file = WP_CONTENT_DIR . '/uploads/mhcard_address_cards/' . $this->ShipmentNumber .'.pdf';
        file_put_contents($file, $filebytes);

        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($file).'"');
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            ob_clean();
            flush();
            readfile($file);
        }else{
            echo __('NO FILE','mh-osoitekortti');
        }
        exit;   
    }
    
}
 


?>
