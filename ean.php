<?php

// Ajout du code EAN

function add_ean_value_input() {
 $args = array(
 'id' => 'ean_value_input',
 'label' => __( 'EAN', 'cfwc' ),
 'class' => 'cfwc-custom-field',
 'desc_tip' => true,
 'description' => __( 'Code EAN du produit', 'ctwc' ),
 );
 woocommerce_wp_text_input( $args );
}

add_action( 'woocommerce_product_options_general_product_data', 'add_ean_value_input' );


// Sauvegarde du code EAN

function save_ean_value_input( $post_id ) {
 $product = wc_get_product( $post_id );
 $ean = isset( $_POST['ean_value_input'] ) ? $_POST['ean_value_input'] : '';
 $product->update_meta_data( 'ean_value_input', sanitize_text_field( $ean ) );
 $product->save();
}
add_action( 'woocommerce_process_product_meta', 'save_ean_value_input' );