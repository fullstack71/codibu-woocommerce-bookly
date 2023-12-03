<?php
/*
Plugin Name: codibu-woocommerce-bookly.
Description: codibu woocommerce bookly.
*/

function codibu_update_bookly_order_item_meta(){
    function codibu_process($items){
        foreach ( $items as $key => $item ) {
            $metadata_prev = wc_get_order_item_meta( $item->order_item_id, 'bookly', true );
            if($metadata_prev) {
                global $wpdb;
                $customer_appointment = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."bookly_customer_appointments WHERE id = ".$metadata_prev["ca_ids"][0]);

                $appointment = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."bookly_appointments WHERE id = ".$customer_appointment[0]->appointment_id);
                $metadata = $metadata_prev;

                if (count($appointment) >= 1 && $metadata_prev["items"][0]["slots"][0][2] != $appointment[0]->start_date && $metadata["slots"][0][2] != $appointment[0]->start_date) {
                    $metadata["slots"][0][2] = $appointment[0]->start_date;
                    $metadata["items"][0]["slots"][0][2] = $appointment[0]->start_date;
                    wc_update_order_item_meta($item->order_item_id, 'bookly', $metadata, $metadata_prev);
                }
            }
        }
    }
    if ($_GET['post'] != null && $_GET['action'] == "edit") {
        global $wpdb;
        $order_items = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."woocommerce_order_items WHERE order_id = ".$_GET['post'] );
        codibu_process($order_items);
    }
}
add_action('after_setup_theme', 'codibu_update_bookly_order_item_meta');
