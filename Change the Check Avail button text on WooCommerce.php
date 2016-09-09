// Change the Check Avail button text on WooCommerce Bookings


add_filter( 'woocommerce_booking_single_check_availability_text', 'wooninja_booking_check_availability_text' );

function wooninja_booking_check_availability_text() {
	return "Request Booking";
}