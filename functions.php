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

add_action( 'estore_after_header' , 'david_test' );
function david_test() {
	//if we're on a blog post, do nothing
	if (!is_front_page() )
		return;
	//Echo the test content
	echo "<div class='front-page-picture'><h1>SHOP LE BONHEUR!</h1><img src='./wp-content/themes/estore-child/assets/images/lemonade3.jpg' alt='test'></div>"; 	
}

add_action ( 'estore_before_main', 'david_before_main_test' );
function david_before_main_test() {
	
}

?>


