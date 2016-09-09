<summary class="generated_coupon_summary">
<?php
	echo '<div class="coupon-content blue dashed small">
	<div class="discount-info">';

	if ( ! empty( $coupon_meta['coupon_amount'] ) && $coupon->amount != 0 ) {
		echo $coupon_meta['coupon_amount'] . ' ' . $coupon_meta['coupon_type'];
		if ( $coupon->free_shipping == "yes" ) {
			echo __( ' &amp; ', self::$text_domain );
		}
	}

	if ( $coupon->free_shipping == "yes" ) {
		echo __( 'Free Shipping', self::$text_domain );
	}
	echo '</div>';

	echo '<div class="code">'. $coupon->code .'</div>';
												
	$show_coupon_description = get_option( 'smart_coupons_show_coupon_description', 'no' );
	if ( ! empty( $coupon_post->post_excerpt ) && $show_coupon_description == 'yes' ) {
		echo '<div class="discount-description">' . $coupon_post->post_excerpt . '</div>';
	}

	if( !empty( $coupon->expiry_date) ) {

		$expiry_date = $this->get_expiration_format( $coupon->expiry_date );

		echo '<div class="coupon-expire">'. $expiry_date .'</div>';
	} else {
		if( !empty( $coupon->usage_limit) ) {
			if( !empty( $coupon->usage_count) ) {
				$usagecount = $coupon->usage_count;
			} else {
				$usagecount = '0';
			}
			echo '<div class="coupon-expire">'. __( 'Current Usage: ' .$usagecount. ' of ' .$coupon->usage_limit. ' lessons' , self::$text_domain ).'</div>';
		} else {
			echo '<div class="coupon-expire">'. __( 'Never Expires ', self::$text_domain ).'</div>';	
		}
	}

	echo '</div>';
	?>
</summary>