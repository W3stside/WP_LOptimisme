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

//add_action( 'estore_after_header' , 'david_expandable_header_dropdowns', 1 );
function david_expandable_header_dropdowns () {
	echo "
	<div class='expandable-dropdown-menus-wrapper'>
		<div class='expandable-dropdown-menus'>
			<ul>
				<li> CRAP </li>
				<li> CRAP 2 </li>
				<li> CRAP 3 </li>
			</ul>
		</div>
	</div>
	";
}

add_action( 'estore_after_header' , 'estore_after_header_banner_picture', 2 );
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
		<img src='./wp-content/themes/estore-child/assets/images/lemonade5.jpg' alt='test'>	
	</div>"; 	
}

add_action ( 'estore_before_main', 'david_before_main_test', 1);
function david_before_main_test() {
	//if we're on a blog post, do nothing
	if (!is_front_page() )
		return;
	//Echo the test content
	echo 
	//BOOTSTRAP RESPONSIVE COLUMNS HERE + 1 BIG - 2 SMALL PICS
	"
	<div class='featured-items-entire-wrapper'>	
		
	</div>"; 	
	}
// ABOVE is removed STILL


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

<?php 
 // ~~~ CUSTOM CSS FOR SOCIAL LOGIN ~~~ // 
  
 // Use a custom CSS file with Social Login
function oa_social_login_set_custom_css($css_theme_uri)
{
 //Replace this URL by an URL to a CSS file on your server
 $css_theme_uri = 'http://localhost/wordpress/wp-content/themes/estore-child/custom/css/sociallogincustom.css';
    
 // Done
 return $css_theme_uri;
}
   
add_filter('oa_social_login_default_css', 'oa_social_login_set_custom_css');
add_filter('oa_social_login_widget_css', 'oa_social_login_set_custom_css');
add_filter('oa_social_login_link_css', 'oa_social_login_set_custom_css');
//END SOCIAL LOGIN// 
 
//Function for adding "SALE!" tags on products AND for showing "LOW STOCK" tags 
if ( ! function_exists( 'estore_template_loop_product_thumbnail' ) ) {

	/**
	 * Get the product thumbnail, or the placeholder if not set.
	 *
	 * @subpackage	Loop
	 * @param string $size (default: 'shop_catalog')
	 * @return string
	 */
	function estore_template_loop_product_thumbnail() {
		global $product, $post;

		$size = 'shop_catalog';

		if ( has_post_thumbnail() ) {
			$image_id = get_post_thumbnail_id($post->ID);
			$image_url = wp_get_attachment_image_src($image_id, $size, false); ?>
			<figure class="products-img">
				<?php echo get_the_post_thumbnail($post->ID, $size ); ?>
				
				<?php 
				//Call variable $customNumLeft to represent number of items left
				$customNumLeft = $product -> get_stock_quantity();
				//If + Else statement for displaing "Low Stock" message if inventory drops below 9 items and shows "Out of Stock" if inventory at 0
				if ( $customNumLeft <= 9 && $customNumLeft >= 1 ) {
					echo apply_filters( 'woocommerce_sale_flash', '<div class="low-inventory-tag">' . esc_html__( 'Only ' . $customNumLeft . ' remaining!', 'estore' ) . '</div>', $post, $product );
				}
				else if ( $customNumLeft === 0 ) {
					echo apply_filters( 'woocommerce_sale_flash', '<div class="low-inventory-tag">' . esc_html__( 'Out of Stock', 'estore' ) . '</div>', $post, $product );
				}
				?>
					<!--Sale Tag-->
				<?php if ( $customNumLeft != 0 && $product->is_on_sale() ) : ?>
					<?php echo apply_filters( 'woocommerce_sale_flash', '<div class="sales-tag">' . esc_html__( 'Sale!', 'estore' ) . '</div>', $post, $product ); ?>
				<?php endif; ?>
				<div class="products-hover-wrapper">
					<div class="products-hover-block">
						<a href="<?php echo $image_url[0]; ?>" class="zoom" data-rel="prettyPhoto"><i class="fa fa-search-plus"> </i></a>
						<?php woocommerce_template_loop_add_to_cart( $product->post, $product ); ?>
					</div>
				</div><!-- featured hover end -->
			</figure>
		<?php
		} else { ?>
			<figure class="products-img">
				<img src="<?php echo estore_woocommerce_placeholder_img_src(); ?>">
				<?php if ( $product->is_on_sale() ) : ?>
					<?php echo apply_filters( 'woocommerce_sale_flash', '<div class="sales-tag">' . esc_html__( 'Sale!', 'estore' ) . '</div>', $post, $product ); ?>
				<?php endif; ?>
				<div class="products-hover-wrapper">
					<div class="products-hover-block">
						<a href="<?php echo estore_woocommerce_placeholder_img_src(); ?>" class="zoom" data-rel="prettyPhoto"><i class="fa fa-search-plus"> </i></a>
						<?php woocommerce_template_loop_add_to_cart( $product->post, $product ); ?>
					</div>
				</div><!-- featured hover end -->
			</figure>
		<?php }
	}
}
 
?>


<!--////////////////////////////-->
<!--Featured Items -> Customizer-->
<!--////////////////////////////-->


<?php

function custom_featured_items_editor ($wp_customize) {

	$wp_customize->add_panel( 'fi_option' , array (
		'priority' => 1, //Priority in the CUSTOMIZER order - this will matter as there are several PANELS and SECTIONS
		'capability' => 'edit_theme_options', //Leave as is, necessary to edit theme
		'title' => __( 'Customizer Featured Items Section' , 'fi_title' ), //Title of PANEL
		'description' => __( 'Customize la section "Featured Items" du site' , 'fi_title' ), //Description when moused over
	));
	//Adds a section to the PANEL (above) which will have all the settings
	$wp_customize->add_section( 'fi_header_section' , array (
		'priority' => 5,	//arbitrary as there is only one section (if there were several, this would matter)
		'title' => __( 'Edit Header' , 'fi_title' ),	//Title of section
		'panel' => 'fi_option',	//What is the name of the PANEL (above) this section should be added to?
	));
	//Add section for Big Pic // Small Pic 1 // Small Pic 2
	$wp_customize->add_section( 'fi_big_pic_section' , array (
		'priority' => 6,	//arbitrary as there is only one section (if there were several, this would matter)
		'title' => __( 'Edit Grande Photo' , 'fi_title' ),	//Title of section
		'panel' => 'fi_option',	//What is the name of the PANEL (above) this section should be added to?
	));
	//Add section for Big Pic // Small Pic 1 // Small Pic 2
	$wp_customize->add_section( 'fi_small_pic_one_section' , array (
		'priority' => 7,	//arbitrary as there is only one section (if there were several, this would matter)
		'title' => __( 'Edit Petite Photo 1' , 'fi_title' ),	//Title of section
		'panel' => 'fi_option',	//What is the name of the PANEL (above) this section should be added to?
	));
	//Add section for Big Pic // Small Pic 1 // Small Pic 2
	$wp_customize->add_section( 'fi_small_pic_two_section' , array (
		'priority' => 8,	//arbitrary as there is only one section (if there were several, this would matter)
		'title' => __( 'Edit Petite Photo 2' , 'fi_title' ),	//Title of section
		'panel' => 'fi_option',	//What is the name of the PANEL (above) this section should be added to?
	));


	  /////////////////////////
	 //		  HEADER        //
	/////////////////////////

	//What settings/options do you want to be editable?
	$wp_customize->add_setting( 'fi_header' , array ( 
		'default' => 'FEATURED ITEMS',
		'type' => 'option',
		'capability' => 'edit_theme_options'
	));

	$wp_customize->add_control( 'fi_header' , array (
		'label' => __( 'Titre du Header' , 'fi_title' ),
		'section' => 'fi_header_section',
		'type' => 'option',
		'priority' => '5',
		'settings' => 'fi_header' 
	));

  ////////////////////////////////////////////////////////////////////////////////
 ////						      BIG PICTURE								 ////
////////////////////////////////////////////////////////////////////////////////	

	  /////////////////////////
	 //	    OVERLAY ONE     //
	/////////////////////////

	//What settings/options do you want to be editable?
	$wp_customize->add_setting( 'fi_overlay_text_big_picture' , array ( 
		'default' => 'SHOP',
		'type' => 'option',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'fi_overlay_text_big_picture' , array (
		'label' => __( 'Grande Photo Overlay Text' , 'fi_title' ),
		'section' => 'fi_big_pic_section',
		'type' => 'option',
		'priority' => '10',
		'settings' => 'fi_overlay_text_big_picture' 
	));

      /////////////////////////
	 //	    PICTURE LINK    //
	/////////////////////////

	//What settings/options do you want to be editable?
	$wp_customize->add_setting( 'fi_big_picture' , array ( 
		'default' => "http://www.clipartkid.com/images/810/preemie-prints-information-blog-lemonade-charity-event-the-texas-thw9uo-clipart.png",
		'type' => 'option',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'fi_big_picture' , array (
		'label' => __( 'Grande Photo URL' , 'fi_title' ),
		'section' => 'fi_big_pic_section',
		'type' => 'option',
		'priority' => '15',
		'settings' => 'fi_big_picture' 
	));

	  /////////////////////////
	 //	    PICTURE ALT     //
	/////////////////////////

	//<img alt=''>
	$wp_customize->add_setting( 'fi_big_picture_alt' , array ( 
		'default' => 'Fresh Lemonade',
		'type' => 'option',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'fi_big_picture_alt' , array (
		'label' => __( 'Grande Photo Description' , 'fi_title' ),
		'section' => 'fi_big_pic_section',
		'type' => 'option',
		'priority' => '20',
		'settings' => 'fi_big_picture_alt' 
	));	

	  /////////////////////////
	 // PICTURE DESTINATION //
	/////////////////////////

	//<img alt=''>
	$wp_customize->add_setting( 'fi_big_picture_destination' , array ( 
		'default' => 'Fresh Lemonade',
		'type' => 'option',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'fi_big_picture_destination' , array (
		'label' => __( 'Grande Photo Destination (en cliquant)' , 'fi_title' ),
		'section' => 'fi_big_pic_section',
		'type' => 'option',
		'priority' => '25',
		'settings' => 'fi_big_picture_destination' 
	));

  ////////////////////////////////////////////////////////////////////////////////
 ////						      SMALL PICTURE 1							 ////
////////////////////////////////////////////////////////////////////////////////

	  /////////////////////////
	 //	    OVERLAY TWO     //
	/////////////////////////

	//What settings/options do you want to be editable?
	$wp_customize->add_setting( 'fi_overlay_text_small_picture_one' , array ( 
		'default' => 'SHOP',
		'type' => 'option',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'fi_overlay_text_small_picture_one' , array (
		'label' => __( 'Petite Photo 1 Overlay Text' , 'fi_title' ),
		'section' => 'fi_small_pic_one_section',
		'type' => 'option',
		'priority' => '50',
		'settings' => 'fi_overlay_text_small_picture_one' 
	));

      /////////////////////////
	 //	    PICTURE LINK    //
	/////////////////////////

	//What settings/options do you want to be editable?
	$wp_customize->add_setting( 'fi_small_picture_one' , array ( 
		'default' => "http://www.clipartkid.com/images/810/preemie-prints-information-blog-lemonade-charity-event-the-texas-thw9uo-clipart.png",
		'type' => 'option',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'fi_small_picture_one' , array (
		'label' => __( 'Petite Photo 1 URL' , 'fi_title' ),
		'section' => 'fi_small_pic_one_section',
		'type' => 'option',
		'priority' => '35',
		'settings' => 'fi_small_picture_one' 
	));

	  /////////////////////////
	 //	    PICTURE ALT     //
	/////////////////////////

	//<img alt=''>
	$wp_customize->add_setting( 'fi_small_picture_one_alt' , array ( 
		'default' => 'Fresh Lemonade',
		'type' => 'option',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'fi_small_picture_one_alt' , array (
		'label' => __( 'Petite Photo 1 Description' , 'fi_title' ),
		'section' => 'fi_small_pic_one_section',
		'type' => 'option',
		'priority' => '40',
		'settings' => 'fi_small_picture_one_alt' 
	));	

	  /////////////////////////
	 // PICTURE DESTINATION //
	/////////////////////////

	//<img alt=''>
	$wp_customize->add_setting( 'fi_small_picture_one_destination' , array ( 
		'default' => 'Fresh Lemonade',
		'type' => 'option',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'fi_small_picture_one_destination' , array (
		'label' => __( 'Petite Photo 1 Destination (en cliquant)' , 'fi_title' ),
		'section' => 'fi_small_pic_one_section',
		'type' => 'option',
		'priority' => '45',
		'settings' => 'fi_small_picture_one_destination' 
	));

  ////////////////////////////////////////////////////////////////////////////////
 ////						      SMALL PICTURE 2							 ////
////////////////////////////////////////////////////////////////////////////////

  	  /////////////////////////
	 //	    OVERLAY THREE   //
	/////////////////////////

	//What settings/options do you want to be editable?
	$wp_customize->add_setting( 'fi_overlay_text_small_picture_two' , array ( 
		'default' => 'SHOP',
		'type' => 'option',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'fi_overlay_text_small_picture_two' , array (
		'label' => __( 'Petite Photo 2 Overlay Text' , 'fi_title' ),
		'section' => 'fi_small_pic_two_section',
		'type' => 'option',
		'priority' => '50',
		'settings' => 'fi_overlay_text_small_picture_two' 
	));

      /////////////////////////
	 //	    PICTURE LINK    //
	/////////////////////////

	//What settings/options do you want to be editable?
	$wp_customize->add_setting( 'fi_small_picture_two' , array ( 
		'default' => "http://www.clipartkid.com/images/810/preemie-prints-information-blog-lemonade-charity-event-the-texas-thw9uo-clipart.png",
		'type' => 'option',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'fi_small_picture_two' , array (
		'label' => __( 'Petite Photo 2 URL' , 'fi_title' ),
		'section' => 'fi_small_pic_two_section',
		'type' => 'option',
		'priority' => '35',
		'settings' => 'fi_small_picture_two' 
	));

	  /////////////////////////
	 //	    PICTURE ALT     //
	/////////////////////////

	//<img alt=''>
	$wp_customize->add_setting( 'fi_small_picture_two_alt' , array ( 
		'default' => 'Fresh Lemonade',
		'type' => 'option',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'fi_small_picture_two_alt' , array (
		'label' => __( 'Petite Photo 2 Description' , 'fi_title' ),
		'section' => 'fi_small_pic_two_section',
		'type' => 'option',
		'priority' => '40',
		'settings' => 'fi_small_picture_two_alt' 
	));	

	  /////////////////////////
	 // PICTURE DESTINATION //
	/////////////////////////

	//<img alt=''>
	$wp_customize->add_setting( 'fi_small_picture_two_destination' , array ( 
		'default' => 'Fresh Lemonade',
		'type' => 'option',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'fi_small_picture_two_destination' , array (
		'label' => __( 'Petite Photo 2 Destination (en cliquant)' , 'fi_title' ),
		'section' => 'fi_small_pic_two_section',
		'type' => 'option',
		'priority' => '45',
		'settings' => 'fi_small_picture_two_destination' 
	));

}

add_action ( 'customize_register' , 'custom_featured_items_editor' );

function custom_featured_items_section () {
//Header
$fi_header = get_option( 'fi_header' , 'FEATURED ITEMS' );
//Big Picture
$fi_overlay_text_one = get_option( "fi_overlay_text_big_picture" , "SHOP" );
$fi_big_pic = get_option("fi_big_picture","http://www.clipartkid.com/images/810/preemie-prints-information-blog-lemonade-charity-event-the-texas-thw9uo-clipart.png");
$fi_big_pic_alt = "Fresh Lemonade";
$fi_big_pic_destination = "http://localhost/wordpress/product/";
//Small Picture Top
$fi_overlay_text_two = "SHOP";
$fi_small_pic_one = "http://www.clipartlord.com/wp-content/uploads/2014/05/unicorn4.png";
$fi_small_pic_one_alt = "Pretty Unicorn of RAINBOWS";
$fi_small_pic_one_destination = "http://localhost/wordpress/product/";
//Small Picture Bottom
$fi_overlay_text_three = "SHOP";
$fi_small_pic_two = "http://66.media.tumblr.com/tumblr_m7q7g3UcLt1qhlsrfo1_1280.jpg";
$fi_small_pic_two_alt = "Support Bras";
$fi_small_pic_two_destination = "http://localhost/wordpress/product/";

?>

<!--Calling jQuery-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
//jQuery script to call at the END
$(document).ready(function() {
	$( ".featured-items-entire-wrapper" ).text( " " );

	$( /*// <html>,<img>,<div> etc NEW CONTENT HERE //*/
		
			"<h1 id='featured-items-h1'><?php echo $fi_header; ?></h1>" +
			"<div id='shop-front-tile-pics-wrapper'>" +
				"<div class='container-fluid'>" +
					"<div class='row' id='shop-front-tile-pics-row'>" +
						"<div class='col-md-8 shop-front-tile-pics-col' id='shop-front-tile-big-pic-col'>" +
							"<a href='<?php echo $fi_big_pic_destination ?>'>" +
								"<div class='shop-front-tile-pics-overlay'>" +
									"<h1><?php echo $fi_overlay_text_one; ?></h1>" +
								"</div>" +
							"</a>" +	
							"<img src='<?php echo $fi_big_pic; ?>' alt='<?php echo $fi_big_pic_alt ?>' class='shop-front-tile-pics-all' id='shop-front-tile-big-pic'>" +
						"</div>" +

						"<div class='col-md-4 shop-front-tile-pics-col shop-front-tile-small-pics-col' id='shop-front-tile-small-pic-top-col'>" +
							"<a href='<?php echo $fi_small_pic_one_destination ?>'>" +						
								"<div class='shop-front-tile-pics-overlay'>" +
									"<h1><?php echo $fi_overlay_text_two; ?></h1>" +
								"</div>" +
							"</a>" +	
							"<img src='<?php echo $fi_small_pic_one; ?>' alt='<?php echo $fi_small_pic_one_alt ?>' class='shop-front-tile-pics-all shop-front-tile-small-pics'>" +
						"</div>" +
						"<div class='col-md-4 shop-front-tile-pics-col shop-front-tile-small-pics-col' id='shop-front-tile-small-pic-bottom-col'>" +
							"<a href='<?php echo $fi_small_pic_two_destination ?>'>" +
								"<div class='shop-front-tile-pics-overlay'>" +
									"<h1><?php echo $fi_overlay_text_three; ?></h1>" +
								"</div>" +
							"</a>" +	
							"<img src='<?php echo $fi_small_pic_two; ?>' alt='<?php echo $fi_small_pic_two_alt ?>' class='shop-front-tile-pics-all shop-front-tile-small-pics'>" +
						"</div>" +
					"</div>" + //.row
				"</div>" + //.container-fluid
			"</div>" //#shop-front-tile-pics-wrapper
		
	).appendTo(".featured-items-entire-wrapper");
}); // End jQUERY
</script>

<?php
}
add_action( "wp_head" , "custom_featured_items_section" );
?>