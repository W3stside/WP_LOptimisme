<?php
/*
* Featured Items Customizer Add
* Allows custom "Featured Items" section to be edited by client
*/
?>

<?php
//Adding Featured Items Section to the WP Customizer
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
//END ABOVE CODE BLOCK
?>
