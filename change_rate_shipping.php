<?php

// Rendre gratuit les frais de ports pour les 100 premières commandes jusqu'au 22 mai exclus 

add_filter( 'cdi_filterarray_shipping_rate','change_rate_shipping') ;
function change_rate_shipping ($rate) {

global $woocommerce, $wpdb;

$newrate = $rate;

$method = explode(':', $rate['id'])[0] ;
$method = str_replace('colissimo_shippingzone_method_','',$method) ;

// Récupération de la date courante

$date_now = date("Y-m-d");
$date_next = '2019-05-22';

$date_now = new DateTime( $date_now );
$date_now = $date_now->format('Ymd');
$date_next = new DateTime( $date_next );
$date_next = $date_next->format('Ymd');

// Récupération du nombre de commande effectuée (commande en cours ou traitée)

 $nb_order = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts WHERE post_type = 'shop_order' AND (post_status = 'wc-processing' OR post_status = 'wc-completed')" );

  if( $date_now  < $date_next )  { // On applique le changement seulement si la date est infèrieur au 22/05

    if ($nb_order <= 100) {

      if ($method == 'pick1') { // Terminaison de l'ID de la methode CDI

          $pricehtcart = 0;
          $newrate['cost'] =  0;

      }


    }


  }

  return $newrate;

}