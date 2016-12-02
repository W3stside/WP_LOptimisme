<?php
function my_theme_enqueue_styles() {

	$parent_style = 'parent-style'; //This is 'estore-style' for the eStore theme.

	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css');
	wp_enqueue_style( 'child-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( $parent_style ),
		wp_get_theme()->get('Version')
		);

}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

add_action( 'estore_after_header' , 'estore_after_header_banner_picture' );
function estore_after_header_banner_picture() {
	//if we're on a blog post, do nothing
	if (!is_front_page() )
		return;
	//Echo the test content
	echo "
	<div class='front-page-picture'>
		<div class='front-page-h1-wrapper'>
			<h1>SHOP LE BONHEUR!</h1>
		</div>	
		<img src='./wp-content/themes/estore-child/assets/images/lemonade4.jpg' alt='test'>	
	</div>"; 	
}

add_action ( 'estore_before_main', 'david_before_main_test', 1);
function david_before_main_test() {
	//if we're on a blog post, do nothing
	if (!is_front_page() )
		return;
	//Echo the test content
	echo 
	//BOOTSTRAP RESPOSINVE COLUMNS HERE + 1 BIG - 2 SMALL PICS
	"
	<h1 id='featured-items-h1'>FEATURED ITEMS</h1>
	<div id='shop-front-tile-pics-wrapper'>
		<div class='container-fluid'>
			<div class='row' id='shop-front-tile-pics-row'>
				<div class='col-md-8 shop-front-tile-pics-col' id='shop-front-tile-big-pic-col'>
					<div class='shop-front-tile-pics-overlay'>
						<h1>SHOP</h1>
					</div>
					<img src='http://www.clipartkid.com/images/810/preemie-prints-information-blog-lemonade-charity-event-the-texas-thw9uo-clipart.png' alt='happy-mug' class='shop-front-tile-pics-all' id='shop-front-tile-big-pic'>
				</div>
				
				<div class='col-md-4 shop-front-tile-pics-col shop-front-tile-small-pics-col' id='shop-front-tile-small-pic-top-col'>
					<div class='shop-front-tile-pics-overlay'>
						<h1>SHOP</h1>
					</div>
					<img src='http://www.clipartlord.com/wp-content/uploads/2014/05/unicorn4.png' alt='unicorn' class='shop-front-tile-pics-all shop-front-tile-small-pics'>
				</div>
				<div class='col-md-4 shop-front-tile-pics-col shop-front-tile-small-pics-col' id='shop-front-tile-small-pic-bottom-col'>
					<div class='shop-front-tile-pics-overlay'>
						<h1>SHOP</h1>
					</div>
					<img src='http://66.media.tumblr.com/tumblr_m7q7g3UcLt1qhlsrfo1_1280.jpg' alt='support-bras' class='shop-front-tile-pics-all shop-front-tile-small-pics'>
				</div>	
			</div> <!--row-->
		</div> <!--container-fluid-->	
	</div>"; 	
	}

add_action('estore_before_main', 'david_latest_products_carousel');
function david_latest_products_carousel () {
		//if we're on a blog post, do nothing
	if (!is_front_page() )
		return;
	//Echo the test content
	echo do_shortcode("[wpcs id='81']");
}

//Social Login
//Handle data retrieved from a social network profile
  function oa_social_login_store_extended_data ($user_data, $identity)
  {
    // $user_data is an object that represents the newly added user
    // The format is similar to the data returned by $user_data = get_userdata ($user_id);
 
    // $identity is an object that contains the full social network profile
     
    //Example to store the gender
    update_user_meta ($user_data->ID, 'gender', $identity->gender);
  }
 
  //This action is called whenever Social Login adds a new user
  add_action ('oa_social_login_action_after_user_insert', 'oa_social_login_store_extended_data', 10, 2);


?>


