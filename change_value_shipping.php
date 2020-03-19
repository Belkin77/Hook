<?php

// Si un pick-up est selectionné, il devient l'adresse de livraison

add_action( 'woocommerce_order_status_processing', 'change_value_shipping', 10, 1 );
function change_value_shipping ($order_id) {

  // Récupérer la commande
  $order = wc_get_order( $order_id );
  
  $note = get_post_meta( $order->id, '_shipping_infos', true );
  $pick_up = get_post_meta( $order->id, '_cdi_meta_pickupLocationlabel', true );

  if (!empty($pick_up)) {

      $pick_up = explode("=>", $pick_up);

      // On récupère le nom du pick_up
      $pick_up_name = $pick_up[0];

      // On récupère le code postal
      preg_match('/[0-9]{5,5}/', $pick_up[1], $matches);
      $pick_up_cp = $matches[0];

      $after_pick_up_name = explode($pick_up_cp, $pick_up[1]);

      $pick_up_street = $after_pick_up_name[0];

      // On récupère la ville associée au pick-up
      $index = strpos($pick_up[1], $matches[0]) + strlen($matches[0]);
      $pick_up_city = substr($pick_up[1], $index);


      // On met à jour les valeurs de l'adresse de livraison
      update_post_meta( $order->id, '_shipping_address_1', $pick_up_name );
      update_post_meta( $order->id, '_shipping_address_2', $pick_up_street);
      update_post_meta( $order->id, '_shipping_postcode', $pick_up_cp );
      update_post_meta( $order->id, '_shipping_city', $pick_up_city );


  }


}