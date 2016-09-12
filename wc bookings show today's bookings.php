global $wpdb;
$today = date("Ymd"); 
$post_status = implode("','", array('confirmed', 'pending-confirmation') );

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
 
			
$pageposts = $wpdb->get_results($querystr, OBJECT);
echo "<pre>";
print_r($pageposts);
echo "</pre>";