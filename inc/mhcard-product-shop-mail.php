<?php
if (!isset($order)) {
  return;
}
ob_start();

?>
  Arvoisa asiakkaamme<br><br>
  Tilauksenne (tilausnumero #<?=esc_html( $order->get_id() );?>) on lähtövalmiina ja odottaa Matkahuollon noutoa.<br>
  
  Tilauspäivämäärä: <?=esc_html( date('H:i:s d.m.Y', strtotime($order->get_date_created())) )?><br><br>
  
  <b>Toimitusosoite</b><br>
  <?=esc_html( $receiver_name ) . '<br>'?>
  <?=esc_html( $receiver_address ) . '<br>'?>
  <?=esc_html( $receiver_postal ) . ' ' . $receiver_city . '<br>'?><br>

  <b>Tilaaja</b><br>
  <?=esc_html( $order->get_billing_first_name() ) . ' ' . esc_html( $order->get_billing_last_name() ) . '<br>'?>
  <?=esc_html( $order->get_billing_address_1() ) . '<br>'?>
  <?=esc_html( $order->get_billing_postcode() ) . ' ' . esc_html( $order->get_billing_city() ) . '<br>'?>

  Puhelin: <?=esc_html( $order->get_billing_phone() ) . '<br>'?>

  Sähköposti: <?=esc_html( $order->get_billing_email() ) . '<br>'?><br>


  <b>Lähettäjä</b><br>
  <?=esc_html( $mh->SenderName1 ) . '<br>'?>
  <?=esc_html( $mh->SenderAddress ) . '<br>'?>
  <?=esc_html( $mh->SenderPostal ) . ' ' .  esc_html( $mh->SenderCity ) . '<br>'?>

  Puhelin: <?=esc_html( $mh->SenderContactNumber )?><br><br>


  Toimituksen lähetystunnus on: <?=esc_html( $mh->ShipmentNumber ) . '<br>'?>

  Voitte sen avulla seurata lähetyksen kulkua osoitteesta <a href="<?php echo esc_url( 'https://www.matkahuolto.fi/seuranta?parcelNumber=' . $mh->ShipmentNumber );?>"?>https://www.matkahuolto.fi/seuranta?parcelNumber=<?=esc_html( $mh->ShipmentNumber )?></a><br>

  Saapumisilmoitus tulee tekstiviestillä antamaanne puhelinnumeroon.<br><br>

  Ystävällisin terveisin<br>

  <?=esc_html( $sender_name ) ?>
                      
                      
<?php
return ob_get_clean();
?>