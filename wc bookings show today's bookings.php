<?php

/////////////////
// getting bookings for today from the db loop
////////////////

global $wpdb;
$today = date("Ymd"); 
$post_status = implode("','", array('confirmed', 'pending-confirmation') );
// Let's get that query built
$querystr = "
    SELECT $wpdb->posts.* 
    FROM $wpdb->posts, $wpdb->postmeta
    WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id
    AND ($wpdb->postmeta.meta_key = '_booking_start'
        AND ($wpdb->postmeta.meta_value BETWEEN '{$today}000000' AND '{$today}235959')) 
    AND $wpdb->posts.post_status IN ('{$post_status}') 
    AND $wpdb->posts.post_type = 'wc_booking'
    AND $wpdb->posts.post_date < NOW()
    ORDER BY $wpdb->posts.post_date DESC
 ";
// let's query that string we made to snag the posts        
$bookings = $wpdb->get_results($querystr, OBJECT);

//start the loop, snoop-a-loop. Bring your green hat.
global $post;
foreach ($bookings as $post):
setup_postdata($post);
// cool, got the loop running now let's build out the variables we'll be using

///////////
// booking details
//////////
$bookingmeta = get_post_meta( get_the_ID() );
$bookingstart = $bookingmeta["_booking_start"][0];
$bookingend = $bookingmeta["_booking_end"][0];

//////////
// associated order details
/////////
$orderid = wp_get_post_parent_id( get_the_ID() );
$order = get_post( $orderid );
$ordermeta = get_post_meta( $orderid );

//////////
// let's get the student and their details
/////////
$studentid = $ordermeta["_customer_user"][0];
$student = get_user_by( 'ID', $studentid );
$studentmeta = get_user_meta( $studentid );

// this is just for looking at whatcha made
echo("<pre>");
print_r($studentmeta);
echo("</pre><br/><br/>");

// ok loop done, close that ish out
endforeach;
?>