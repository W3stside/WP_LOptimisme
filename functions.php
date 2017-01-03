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
?>

<?php 
//Loads in Banner Pic Action Hook
include 'includes/frontpage-banner.php';?>

<?php
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
?>

<?php 
//Adds extended tags for products
include 'includes/frontpage-extendedtags.php';
?>

<?php
//Loads in the FEATURED ITEMS section and adds options to Customizer UI
include 'includes/frontpage-featureditems.php';
?>

<?php
//loads in PRESSES section - is_front_page onl
include 'includes/frontpage-presses.php';
?>

<?php
//adding Hoverable Menus PHP and jQuery
//include 'includes/hoverable-menus.php';
?>

<?php
//My Account page customizations
include 'includes/my-account-customization.php';
?>

<?php
//Extend Walker Nav
include 'includes/walker_nav_menu_extension.php';
?>

