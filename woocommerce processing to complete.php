<?php
function wc_mark_all_orders_as_complete( $order_status, $order_id ) {
	$order = new WC_Order( $order_id );
	if ( $order_status == 'processing' ) { 
		return 'completed';
	}
	return $order_status;
}
add_filter( 'woocommerce_payment_complete_order_status', 'wc_mark_all_orders_as_complete', 10, 2 );
?>