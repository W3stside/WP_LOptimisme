<?php
/*
////////////////////////
//MY ACCOUNT SECTIONS//
//////////////////////
*/

//MY ACCOUNT PAGE CSS via jQUERY

	add_filter('woocommerce_before_account_navigation','my_custom_account_page');
	function my_custom_account_page() {
		if (! is_account_page() || ! is_user_logged_in()) {
			return;
		} else {
			?>
			<script>
			$(document).ready(function () {
				$("#primary").css({width: '72.5%', float: 'left'},0);
				$("#fp_greeting").css({position: 'relative', textAlign: 'left', margin: '-75px 0 15px 35px', color: 'black'},0);
				$("#fp_greeting strong, #fp_greeting a").css({color: 'grey'},0);
				$(".title").addClass('myaccount-title');
				
			});
			</script> <?php
		}
	}
?>
<?php
//Personalized Greeting and BECOME VENDOR || SHOP NOW buttons

	add_filter( 'woocommerce_before_account_navigation' , 'custom_before_template' );

	function custom_before_template() {

		$current_user = wp_get_current_user();

		echo "<h5 id='fp_greeting'>";
			echo sprintf( esc_attr__( 'Bienvenue %s%s%s :) (not %2$s? %sSign out%s)', 'estore' ), '<strong>', esc_html( $current_user->display_name ), '</strong>', '<a href="' . esc_url( wc_logout_url( wc_get_page_permalink( 'myaccount' ) ) ) . '">', '</a>' ); 	
		echo "</h5>";

		echo '
		<div class="container-fluid round-box">
			<div class="row">

				<div class="col-md-12 top-block">
					<h3>La Boutique de Bonheur!</h3>
					<a href="http://localhost/wordpress/shop" class="myaccount-button" id="button-shop-now">
						Shop Now!
					</a>
					<a href="http://localhost/wordpress/vendor_dashboard" class="myaccount-button" id="button-sell-now">
						Become a Vendor!
					</a>
				</div>
			</div>
		</div>
		';
	}

	add_filter('woocommerce_after_my_account','custom_wishlist_account_div');

	function custom_wishlist_account_div () {
		echo '<div class="col-md-12 middle-block">';
		echo 	'<h5>Ma Wishlist:</h5>';
		echo 	do_shortcode ('[yith_wcwl_wishlist]');
		echo '</div>';
	}	
////////////////////////////
//END MY ACCOUNT SECTIONS//
//////////////////////////
?>
