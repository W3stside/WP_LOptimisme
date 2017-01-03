<?php
/*
*eStore Child Theme Action Hook - Banner Picture
*Comes right after the end of the page header and is ONLY for the front page
*Includes welcome message for users logged in
*/
?>

<?php
add_action( 'estore_after_header' , 'estore_after_header_banner_picture', 2 );
function estore_after_header_banner_picture() {

	$current_user = wp_get_current_user();

	//if we're on a blog post, do nothing
	if (!is_front_page()) {
		return;
	} else if (is_front_page() && !is_user_logged_in()){
		echo "<div class='front-page-picture'>";
		echo "<div class='front-page-h1-wrapper'>";
			echo "<h1>";
				echo "<a href='#'>SHOP LE BONHEUR!</a>";
			echo "</h1>";
		echo "</div>";
		echo "<div id='fp_pic_overlay'>";	
			echo "<img id='fp_pic_large' src='./wp-content/themes/estore-child/assets/images/lemonade7.jpg' alt='test'>";
		echo "</div>";
	echo "</div>"; 	
	} else if (is_front_page() && is_user_logged_in() === true) {
	//Echo the test content
	echo "<div class='front-page-picture'>";
		echo "<div class='front-page-h1-wrapper'>";
			echo "<h1><a href='#'>SHOP LE BONHEUR!</a></h1>";
			echo "<h3 id='fp_greeting'>";
				echo sprintf( esc_attr__( 'Bienvenue %s%s%s :)'), '<strong>', esc_html( $current_user->display_name ), '</strong>', '<a href="' . esc_url( wc_logout_url( wc_get_page_permalink( 'myaccount' ) ) ) . '">', '</a>' );
			echo "</h3>";	
		echo "</div>";
		echo "<div id='fp_pic_overlay'>";	
			echo "<img id='fp_pic_large' src='./wp-content/themes/estore-child/assets/images/lemonade7.jpg' alt='test'>";
		echo "</div>";
	echo "</div>"; 	
	}
}
?>