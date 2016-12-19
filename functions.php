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

/*add_action( 'estore_after_header' , 'estore_after_header_welcome', 1 );
function estore_after_header_welcome() {

	$current_user = wp_get_current_user();

	if (!is_front_page()) 
	//if we're on a blog post, do nothing
	return;

	//Echo the test content
	echo "<h5 id='fp_greeting'>";
		echo sprintf( esc_attr__( 'Bienvenue %s%s%s :) (not %2$s? %sSign out%s)', 'estore' ), '<strong>', esc_html( $current_user->display_name ), '</strong>', '<a href="' . esc_url( wc_logout_url( wc_get_page_permalink( 'myaccount' ) ) ) . '">', '</a>' ); 	
	echo "</h5>";
}*/

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
			echo "<img id='fp_pic_large' src='./wp-content/themes/estore-child/assets/images/lemonade7.jpeg' alt='test'>";
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
			echo "<img id='fp_pic_large' src='./wp-content/themes/estore-child/assets/images/lemonade7.jpeg' alt='test'>";
		echo "</div>";
	echo "</div>"; 	
	}
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


add_action('estore_before_main', 'david_latest_products_carousel',10,1);
function david_latest_products_carousel () {
		//if we're on a blog post, do nothing
	if (!is_front_page() )
		return;
	//Echo the test content
	echo do_shortcode("[wpcs id='81']");
}

add_action('estore_before_main', 'david_amazon_link',10,2);
function david_amazon_link () {
		//if we're on a blog post, do nothing
	if (!is_front_page() )
		return;
	//Echo the test content

}	

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
		'default' => "https://s-media-cache-ak0.pinimg.com/564x/1c/49/89/1c49890c41d42dbda547310728e4d35b.jpg",
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
		'default' => "http://weknowmemes.com/wp-content/uploads/2012/07/support-bras.jpeg",
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
$fi_big_pic_alt = get_option( "fi_big_picture_alt" , "Fresh Lemonade" );
$fi_big_pic_destination = get_option("fi_big_picture_destination","http://localhost/wordpress/product/");
//Small Picture Top
$fi_overlay_text_two = get_option("fi_overlay_text_small_picture_one","SHOP");
$fi_small_pic_one = get_option("fi_small_picture_one","https://s-media-cache-ak0.pinimg.com/564x/1c/49/89/1c49890c41d42dbda547310728e4d35b.jpg");
$fi_small_pic_one_alt = get_option("fi_small_picture_one_alt","Pretty Unicorn of RAINBOWS");
$fi_small_pic_one_destination = get_option("fi_small_picture_one_destination","http://localhost/wordpress/product/");
//Small Picture Bottom
$fi_overlay_text_three = get_option("fi_overlay_text_small_picture_two","SHOP");
$fi_small_pic_two = get_option("fi_small_picture_two","http://weknowmemes.com/wp-content/uploads/2012/07/support-bras.jpeg");
$fi_small_pic_two_alt = get_option("fi_small_picture_two_alt","Support Bras");
$fi_small_pic_two_destination = get_option("fi_small_picture_two_destination","http://localhost/wordpress/product/");

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

//CUSTOM HOVERABLE MENU HEADER OPTIONS FOR CUSTOMIZER
?>

<?php

function custom_hover_menu_editor ($wp_customize) {

	$wp_customize->add_panel( 'hm_option' , array (
		'priority' => 1, //Priority in the CUSTOMIZER order - this will matter as there are several PANELS and SECTIONS
		'capability' => 'edit_theme_options', //Leave as is, necessary to edit theme
		'title' => __( 'Customizer Hoverable Menu' , 'hm_title' ), //Title of PANEL
		'description' => __( 'Customizer les dropdown menu pour chaque Category' , 'hm_title' ), //Description when moused over
	));
	//Adds a section to the PANEL (above) which will have all the settings
	$wp_customize->add_section( 'hm_1_section' , array (
		'priority' => 5,	//arbitrary as there is only one section (if there were several, this would matter)
		'title' => __( 'Changer Menu 1' , 'hm_title' ),	//Title of section
		'panel' => 'hm_option',	//What is the name of the PANEL (above) this section should be added to?
	));
	//Adds a section to the PANEL (above) which will have all the settings
	$wp_customize->add_section( 'hm_2_section' , array (
		'priority' => 5,	//arbitrary as there is only one section (if there were several, this would matter)
		'title' => __( 'Changer Menu 2' , 'hm_title' ),	//Title of section
		'panel' => 'hm_option',	//What is the name of the PANEL (above) this section should be added to?
	));
	//Adds a section to the PANEL (above) which will have all the settings
	$wp_customize->add_section( 'hm_3_section' , array (
		'priority' => 5,	//arbitrary as there is only one section (if there were several, this would matter)
		'title' => __( 'Changer Menu 3' , 'hm_title' ),	//Title of section
		'panel' => 'hm_option',	//What is the name of the PANEL (above) this section should be added to?
	));
	//Adds a section to the PANEL (above) which will have all the settings
	$wp_customize->add_section( 'hm_4_section' , array (
		'priority' => 5,	//arbitrary as there is only one section (if there were several, this would matter)
		'title' => __( 'Changer Menu 4' , 'hm_title' ),	//Title of section
		'panel' => 'hm_option',	//What is the name of the PANEL (above) this section should be added to?
	));
	//Adds a section to the PANEL (above) which will have all the settings
	$wp_customize->add_section( 'hm_5_section' , array (
		'priority' => 5,	//arbitrary as there is only one section (if there were several, this would matter)
		'title' => __( 'Changer Menu 5' , 'hm_title' ),	//Title of section
		'panel' => 'hm_option',	//What is the name of the PANEL (above) this section should be added to?
	));
	//Adds a section to the PANEL (above) which will have all the settings
	$wp_customize->add_section( 'hm_6_section' , array (
		'priority' => 5,	//arbitrary as there is only one section (if there were several, this would matter)
		'title' => __( 'Changer Menu 6' , 'hm_title' ),	//Title of section
		'panel' => 'hm_option',	//What is the name of the PANEL (above) this section should be added to?
	));
	//Adds a section to the PANEL (above) which will have all the settings
	$wp_customize->add_section( 'hm_7_section' , array (
		'priority' => 5,	//arbitrary as there is only one section (if there were several, this would matter)
		'title' => __( 'Changer Menu 7' , 'hm_title' ),	//Title of section
		'panel' => 'hm_option',	//What is the name of the PANEL (above) this section should be added to?
	));
	//Adds a section to the PANEL (above) which will have all the settings
	$wp_customize->add_section( 'hm_8_section' , array (
		'priority' => 5,	//arbitrary as there is only one section (if there were several, this would matter)
		'title' => __( 'Changer Menu 8' , 'hm_title' ),	//Title of section
		'panel' => 'hm_option',	//What is the name of the PANEL (above) this section should be added to?
	));

//Livres Settings

	  /////////////////////////
	 //	   HEADER  ONE      //
	/////////////////////////

	//What settings/options do you want to be editable?
	$wp_customize->add_setting( 'hm_header_1' , array ( 
		'default' => 'SHOP',
		'type' => 'option',
		'capability' => 'edit_theme_options'
	));

	$wp_customize->add_control( 'hm_header_1' , array (
		'label' => __( 'Header 1' , 'hm_title' ),
		'section' => 'hm_1_section',
		'type' => 'option',
		'priority' => '5',
		'settings' => 'hm_header_1' 
	));

	  /////////////////////////
	 //	   Picture Link     //
	/////////////////////////

	//What settings/options do you want to be editable?
	$wp_customize->add_setting( 'hm_img_1' , array ( 
		'default' => 'http://quincypublicschools.com/library/files/2011/08/book-stack.png',
		'type' => 'option',
		'capability' => 'edit_theme_options'
	));

	$wp_customize->add_control( 'hm_img_1' , array (
		'label' => __( 'Featured Image' , 'hm_title' ),
		'section' => 'hm_1_section',
		'type' => 'option',
		'priority' => '5',
		'settings' => 'hm_img_1' 
	));
	  /////////////////////////
	 //	   <li> section     //
	/////////////////////////

	//What settings/options do you want to be editable?
	$wp_customize->add_setting( 'hm_list_content_1' , array ( 
		'default' => '',
		'type' => 'option',
		'capability' => 'edit_theme_options'
	));

	$wp_customize->add_control( 'hm_list_content_1' , array (
		'label' => __( '<li> Content' , 'hm_title' ),
		'section' => 'hm_1_section',
		'type' => 'option',
		'priority' => '5',
		'settings' => 'hm_list_content_1' 
	));

}

//Adding the hover menu and Customizer ability

add_action ( 'customize_register' , 'custom_hover_menu_editor' );
function custom_hover_menu_section () {
	//Livres
	$hm_header_1 = get_option( 'hm_header_1' , 'Shop Livres' );
	$hm_img_1 = get_option( 'hm_img_1' , 'http://quincypublicschools.com/library/files/2011/08/book-stack.png' );
	//$hm_list_content_1 = get_option( 'hm_header_1' , 'Shop Livres' );
	?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script type='text/javascript'>
	$(document).ready(function() {

		var hoverMenu1 = $(
	      			'<div class="hovermenu-wrapper">'+
		              '<div class="col-xs-4">' +
		                '<img class="img-responsive" src="<?php echo $hm_img_1 ?>" alt="<?php/*$variableHere*/?>">' +
		              '</div>' +
		    
		              '<div class="col-xs-4">' +
		                '<h1><?php echo $hm_header_1 ?></h1><br/>' +
		                '<ul class="" style="list-style: none">' +
		                  '<li><a href="<?php/*$variableHere*/?>"><?php //someshit?></a></li><br/>' +
		                  '<li><a href="<?php/*$variableHere*/?>"><?php/*$variableHere*/?></a></li><br/>' +
		                  '<li><a href="<?php/*$variableHere*/?>"><?php/*$variableHere*/?></a></li><br/>' +
		                  '<li><a href="<?php/*$variableHere*/?>"><?php/*$variableHere*/?></a></li><br/>' +
		                '</ul>' +
		              '</div>' +
			
		              '<div class="col-xs-4">' +
		                '<h1><?php/*$variableHere*/?></h1><br/>' +
		                '<ul class="" style="list-style: none">' +
		                  '<li><a href="<?php/*$variableHere*/?>"><?php/*$variableHere*/?></a></li><br/>' +
		                  '<li><a href="<?php/*$variableHere*/?>"><?php/*$variableHere*/?></a></li><br/>' +
		                  '<li><a href="<?php/*$variableHere*/?>"><?php/*$variableHere*/?></a></li><br/>' +
		                  '<li><a href="<?php/*$variableHere*/?>"><?php/*$variableHere*/?></a></li><br/>' +
		                '</ul>' +
		              '</div>' +
		            '</div>' //Hoverwrapper DIV END  	
			);

		var hoverMenu2 = $(
	      			'<div class="hovermenu-wrapper">'+
		              '<div class="col-xs-4">' +
		                '<img class="img-responsive" src="<?php/*$variableHere*/?>" alt="<?php/*$variableHere*/?>">' +
		              '</div>' +
		    
		              '<div class="col-xs-4">' +
		                '<h1><?php echo $hm_header_2 ?></h1><br/>' +
		                '<ul class="" style="list-style: none">' +
		                  '<li><a href="<?php/*$variableHere*/?>"><?php/*$variableHere*/?></a></li><br/>' +
		                  '<li><a href="<?php/*$variableHere*/?>"><?php/*$variableHere*/?></a></li><br/>' +
		                  '<li><a href="<?php/*$variableHere*/?>"><?php/*$variableHere*/?></a></li><br/>' +
		                  '<li><a href="<?php/*$variableHere*/?>"><?php/*$variableHere*/?></a></li><br/>' +
		                '</ul>' +
		              '</div>' +
			
		              '<div class="col-xs-4">' +
		                '<h1><?php/*$variableHere*/?></h1><br/>' +
		                '<ul class="" style="list-style: none">' +
		                  '<li><a href="<?php/*$variableHere*/?>"><?php/*$variableHere*/?></a></li><br/>' +
		                  '<li><a href="<?php/*$variableHere*/?>"><?php/*$variableHere*/?></a></li><br/>' +
		                  '<li><a href="<?php/*$variableHere*/?>"><?php/*$variableHere*/?></a></li><br/>' +
		                  '<li><a href="<?php/*$variableHere*/?>"><?php/*$variableHere*/?></a></li><br/>' +
		                '</ul>' +
		              '</div>' +
		            '</div>' //Hoverwrapper DIV END  	
			);

		var hoverMenu3 = $(
		  			'<div class="hovermenu-wrapper">'+
		              '<div class="col-xs-4">' +
		                '<img class="img-responsive" src="<?php/*$variableHere*/?>" alt="<?php/*$variableHere*/?>">' +
		              '</div>' +
		    
		              '<div class="col-xs-4">' +
		                '<h1><?php echo $hm_header_3 ?></h1><br/>' +
		                '<ul class="" style="list-style: none">' +
		                  '<li><a href="<?php/*$variableHere*/?>"><?php/*$variableHere*/?></a></li><br/>' +
		                  '<li><a href="<?php/*$variableHere*/?>"><?php/*$variableHere*/?></a></li><br/>' +
		                  '<li><a href="<?php/*$variableHere*/?>"><?php/*$variableHere*/?></a></li><br/>' +
		                  '<li><a href="<?php/*$variableHere*/?>"><?php/*$variableHere*/?></a></li><br/>' +
		                '</ul>' +
		              '</div>' +
			
		              '<div class="col-xs-4">' +
		                '<h1><?php/*$variableHere*/?></h1><br/>' +
		                '<ul class="" style="list-style: none">' +
		                  '<li><a href="<?php/*$variableHere*/?>"><?php/*$variableHere*/?></a></li><br/>' +
		                  '<li><a href="<?php/*$variableHere*/?>"><?php/*$variableHere*/?></a></li><br/>' +
		                  '<li><a href="<?php/*$variableHere*/?>"><?php/*$variableHere*/?></a></li><br/>' +
		                  '<li><a href="<?php/*$variableHere*/?>"><?php/*$variableHere*/?></a></li><br/>' +
		                '</ul>' +
		              '</div>' +
		            '</div>' //Hoverwrapper DIV END  	
			);

		var hoverMenu4 = $(
		  			'<div class="hovermenu-wrapper">'+
		              '<div class="col-xs-4">' +
		                '<img class="img-responsive" src="<?php/*$variableHere*/?>" alt="<?php/*$variableHere*/?>">' +
		              '</div>' +
		    
		              '<div class="col-xs-4">' +
		                '<h1><?php echo $hm_header_4 ?></h1><br/>' +
		                '<ul class="" style="list-style: none">' +
		                  '<li><a href="<?php/*$variableHere*/?>"><?php/*$variableHere*/?></a></li><br/>' +
		                  '<li><a href="<?php/*$variableHere*/?>"><?php/*$variableHere*/?></a></li><br/>' +
		                  '<li><a href="<?php/*$variableHere*/?>"><?php/*$variableHere*/?></a></li><br/>' +
		                  '<li><a href="<?php/*$variableHere*/?>"><?php/*$variableHere*/?></a></li><br/>' +
		                '</ul>' +
		              '</div>' +
			
		              '<div class="col-xs-4">' +
		                '<h1><?php/*$variableHere*/?></h1><br/>' +
		                '<ul class="" style="list-style: none">' +
		                  '<li><a href="<?php/*$variableHere*/?>"><?php/*$variableHere*/?></a></li><br/>' +
		                  '<li><a href="<?php/*$variableHere*/?>"><?php/*$variableHere*/?></a></li><br/>' +
		                  '<li><a href="<?php/*$variableHere*/?>"><?php/*$variableHere*/?></a></li><br/>' +
		                  '<li><a href="<?php/*$variableHere*/?>"><?php/*$variableHere*/?></a></li><br/>' +
		                '</ul>' +
		              '</div>' +
		            '</div>' //Hoverwrapper DIV END  	
			);

		var hoverMenu5 = $(
		  			'<div class="hovermenu-wrapper">'+
		              '<div class="col-xs-4">' +
		                '<img class="img-responsive" src="<?php/*$variableHere*/?>" alt="<?php/*$variableHere*/?>">' +
		              '</div>' +
		    
		              '<div class="col-xs-4">' +
		                '<h1><?php echo $hm_header_5 ?></h1><br/>' +
		                '<ul class="" style="list-style: none">' +
		                  '<li><a href="<?php/*$variableHere*/?>"><?php/*$variableHere*/?></a></li><br/>' +
		                  '<li><a href="<?php/*$variableHere*/?>"><?php/*$variableHere*/?></a></li><br/>' +
		                  '<li><a href="<?php/*$variableHere*/?>"><?php/*$variableHere*/?></a></li><br/>' +
		                  '<li><a href="<?php/*$variableHere*/?>"><?php/*$variableHere*/?></a></li><br/>' +
		                '</ul>' +
		              '</div>' +
			
		              '<div class="col-xs-4">' +
		                '<h1><?php/*$variableHere*/?></h1><br/>' +
		                '<ul class="" style="list-style: none">' +
		                  '<li><a href="<?php/*$variableHere*/?>"><?php/*$variableHere*/?></a></li><br/>' +
		                  '<li><a href="<?php/*$variableHere*/?>"><?php/*$variableHere*/?></a></li><br/>' +
		                  '<li><a href="<?php/*$variableHere*/?>"><?php/*$variableHere*/?></a></li><br/>' +
		                  '<li><a href="<?php/*$variableHere*/?>"><?php/*$variableHere*/?></a></li><br/>' +
		                '</ul>' +
		              '</div>' +
		            '</div>' //Hoverwrapper DIV END  	
			);


		//Adds hover menu html formatting
		$( ".expandable_dropdown_menus_wrapper" ).text( " " );	
		$(	//Hover Menu HTML
	        '<div class="expandable-dropdown-menus">' +
	          '<div class="container-fluid">' +
	            '<div id="dicksdiv" class="rowcustom row">' +
	            
	            '</div>' + /* ROW */ 
	          '</div>' + /* CONTAINER-FLUID */
	        '</div>').appendTo(".expandable_dropdown_menus_wrapper");

		$(".menu-item").mouseenter(function() {
			$(this).addClass("activeHover");
			$(this).children('div:first').stop(true,true).animate({height: '300px'} , 0);
			if($(this).hasClass('menu-item-livres')) {
				$(hoverMenu1).appendTo('.rowcustom');
			} else if ($(this).hasClass('menu-item-livres')) {
				$(hoverMenu2).appendTo('.rowcustom');
			} else if ($(this).hasClass('menu-item-bijoux')) {
				$(hoverMenu3).appendTo('.rowcustom'); 
			} else if ($(this).hasClass('menu-item-mode-femme')) {
				$(hoverMenu4).appendTo('.rowcustom'); 
			} else {
				$(hoverMenu5).appendTo('.rowcustom');
			}	
			});

		$(".menu-item").mouseleave(function() {
			$(".hovermenu-wrapper").remove();
			$(this).removeClass("activeHover");
			$(this).children('div:first').stop(true,true).animate({height: '0px'} , 0);
		});

		
	});	
</script> 
<?php
}

add_action( "wp_head" , "custom_hover_menu_section" );
?>

<?php

////////////////////////
//MY ACCOUNT SECTIONS//
//////////////////////

//MY ACCOUNT PAGE CSS via jQUERY

	add_filter('woocommerce_before_account_navigation','my_custom_account_page');
	function my_custom_account_page() {
		if (!is_account_page()) {
			return;
		} else {
			?>
			<script>
			$(document).ready(function () {
				$("#primary").css({width: '72.5%', float: 'left'},0);
				$("#fp_greeting").css({position: 'relative', textAlign: 'left', margin: '-75px 0 15px 35px', color: 'black'},0);
				$("#fp_greeting strong, #fp_greeting a").css({color: 'grey'},0);
				$(".title").css({},0);
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
?>

<?php
//PRESSES SECTION

	add_filter('estore_before_footer_sidebar','david_before_footer_sidebar');
	function david_before_footer_sidebar() {
		echo '<div class="news_about_us" style="width: 100%; margin: 0 auto;">';
			echo '<div class="news_about_us_wrapper">';
				echo'<h5>Ils parlent de nous!</h5>';
				echo '<div class="container-fluid">';
					echo '<div id="nau_row" class="row">';

			//START CONTENT			

						echo '<div class="col-md-3">';
							echo '<a href="http://www.leparisien.fr/societe/ca-se-travaille-tous-les-jours-18-09-2016-6129265.php"><img class="nau_image" src="http://localhost/wordpress/wp-content/themes/estore-child/assets/images/presses/leparisien.png" title="le-parisien" alt="le-parisien-presses"></a>';
						echo '</div>';
						echo '<div class="col-md-3">';
							echo '<a href="https://www.francebleu.fr/emissions/ondes-positives/107-1/olivier-toussaint-cofondateur-du-site-loptimisme-com"><img class="nau_image" src="http://localhost/wordpress/wp-content/themes/estore-child/assets/images/presses/francebleu.png" title="france-bleu" alt="france-bleu-presse"></a>';
						echo '</div>';
						echo '<div class="col-md-3">';
							echo '<a href="https://www.maddyness.com/finance/2016/08/01/maddycrowd-loptimisme-site-dactualites-positives-donne-sourire/"><img class="nau_image" src="http://localhost/wordpress/wp-content/themes/estore-child/assets/images/presses/maddyness.png" title="maddyness" alt="maddyness-presse"></a>';
						echo '</div>';
						echo '<div class="col-md-3">';
							echo '<a href="http://www.france2.fr/emissions/telematin/videos/replay_-_telematin_20-08-2016_1251773"><img class="nau_image" src="http://localhost/wordpress/wp-content/themes/estore-child/assets/images/presses/digital-business-news.png" title="digital-business-news" alt="digital-business-news-presse"></a>';
						echo '</div>';

			//END CONTENT				

					echo '</div>'; /*row*/
				echo '</div>'; /*container-fluid*/
			echo '</div>'; /*news_about_us_wrapper*/
		echo '</div>'; /*news_about_us*/							
	}

////////////////////////////
//END MY ACCOUNT SECTIONS//
//////////////////////////

?>

<?php
//EDITING WP NAV MENU

class New_Walker_Nav_Menu extends Walker	{
	/**
	 * What the class handles.
	 *
	 * @since 3.0.0
	 * @access public
	 * @var string
	 *
	 * @see Walker::$tree_type
	 */
	public $tree_type = array( 'post_type', 'taxonomy', 'custom' );

	/**
	 * Database fields to use.
	 *
	 * @since 3.0.0
	 * @access public
	 * @todo Decouple this.
	 * @var array
	 *
	 * @see Walker::$db_fields
	 */
	public $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );

	/**
	 * Starts the list before the elements are added.
	 *
	 * @since 3.0.0
	 *
	 * @see Walker::start_lvl()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of wp_nav_menu() arguments.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"sub-menu\">\n";
	}

	/**
	 * Ends the list of after the elements are added.
	 *
	 * @since 3.0.0
	 *
	 * @see Walker::end_lvl()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of wp_nav_menu() arguments.
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}

	/**
	 * Starts the element output.
	 *
	 * @since 3.0.0
	 * @since 4.4.0 The {@see 'nav_menu_item_args'} filter was added.
	 *
	 * @see Walker::start_el()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of wp_nav_menu() arguments.
	 * @param int    $id     Current item ID.
	 */

	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$category = get_category( $item->object_id );

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . (!empty($category->slug) ? $category->slug : $item->ID);

		/**
		 * Filters the arguments for a single nav menu item.
		 *
		 * @since 4.4.0
		 *
		 * @param array  $args  An array of arguments.
		 * @param object $item  Menu item data object.
		 * @param int    $depth Depth of menu item. Used for padding.
		 */
		$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

		/**
		 * Filters the CSS class(es) applied to a menu item's list item element.
		 *
		 * @since 3.0.0
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param array  $classes The CSS classes that are applied to the menu item's `<li>` element.
		 * @param object $item    The current menu item.
		 * @param array  $args    An array of wp_nav_menu() arguments.
		 * @param int    $depth   Depth of menu item. Used for padding.
		 */
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		/**
		 * Filters the ID applied to a menu item's list item element.
		 *
		 * @since 3.0.1
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param string $menu_id The ID that is applied to the menu item's `<li>` element.
		 * @param object $item    The current menu item.
		 * @param array  $args    An array of wp_nav_menu() arguments.
		 * @param int    $depth   Depth of menu item. Used for padding.
		 */

/*NEW CONTENT
*Adding lines 776 and 779 to new Walker
*Appends Primary Header Product Category SLUG to the class for easy editing as opposed to ID.
*If there is no SLUG - appends ID instead
*/					
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. (!empty($category->slug) ? $category->slug : $item->ID), $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

/*End custom Walker content*/

		$output .= $indent . '<li' . $id . $class_names .'>';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

		/**
		 * Filters the HTML attributes applied to a menu item's anchor element.
		 *
		 * @since 3.6.0
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param array $atts {
		 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
		 *
		 *     @type string $title  Title attribute.
		 *     @type string $target Target attribute.
		 *     @type string $rel    The rel attribute.
		 *     @type string $href   The href attribute.
		 * }
		 * @param object $item  The current menu item.
		 * @param array  $args  An array of wp_nav_menu() arguments.
		 * @param int    $depth Depth of menu item. Used for padding.
		 */
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		/** This filter is documented in wp-includes/post-template.php */
		$title = apply_filters( 'the_title', $item->title, $item->ID );

		/**
		 * Filters a menu item's title.
		 *
		 * @since 4.4.0
		 *
		 * @param string $title The menu item's title.
		 * @param object $item  The current menu item.
		 * @param array  $args  An array of wp_nav_menu() arguments.
		 * @param int    $depth Depth of menu item. Used for padding.
		 */
		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . $title . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		/**
		 * Filters a menu item's starting output.
		 *
		 * The menu item's starting output only includes `$args->before`, the opening `<a>`,
		 * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
		 * no filter for modifying the opening and closing `<li>` for a menu item.
		 *
		 * @since 3.0.0
		 *
		 * @param string $item_output The menu item's starting HTML output.
		 * @param object $item        Menu item data object.
		 * @param int    $depth       Depth of menu item. Used for padding.
		 * @param array  $args        An array of wp_nav_menu() arguments.
		 */
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	/**
	 * Ends the element output, if needed.
	 *
	 * @since 3.0.0
	 *
	 * @see Walker::end_el()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Page data object. Not used.
	 * @param int    $depth  Depth of page. Not Used.
	 * @param array  $args   An array of wp_nav_menu() arguments.
	 */
	public function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$output .= "</li>\n";
	}

} // Walker_Nav_Menu
?>


