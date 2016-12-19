<?php

function custom_hover_menu_editor ($wp_customize) {

	$wp_customize->add_panel( 'hm_option' , array (
		'priority' => 1, //Priority in the CUSTOMIZER order - this will matter as there are several PANELS and SECTIONS
		'capability' => 'edit_theme_options', //Leave as is, necessary to edit theme
		'title' => __( 'Customizer Hoverable Menu' , 'hm_title' ), //Title of PANEL
		'description' => __( 'Customizer les dropdown menu pour chaque Category' , 'hm_title' ), //Description when moused over
	));
	//Adds a section to the PANEL (above) which will have all the settings
	$wp_customize->add_section( 'hm_menu_section' , array (
		'priority' => 5,	//arbitrary as there is only one section (if there were several, this would matter)
		'title' => __( 'Edit Hoverable Menus' , 'hm_title' ),	//Title of section
		'panel' => 'hm_option',	//What is the name of the PANEL (above) this section should be added to?
	));

	  /////////////////////////
	 //	   HEADER  MENUS    //
	/////////////////////////

	//What settings/options do you want to be editable?
	$wp_customize->add_setting( 'hm_header_1' , array ( 
		'default' => ' ',
		'type' => 'option',
		'capability' => 'edit_theme_options'
	));

	$wp_customize->add_control( 'hm_header' , array (
		'label' => __( 'Knitwear Menu' , 'hm_title' ),
		'section' => 'hm_menu_section',
		'type' => 'option',
		'priority' => '5',
		'settings' => 'hm_header_1' 
	));
}

add_action ( 'customize_register' , 'custom_hover_menu_editor' );

function custom_hover_menu_section () {
//Header
$hm_header_one = get_option( 'hm_header_1' , 'H-H-H-HOLY SHIT' );

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type='text/javascript'>
$(document).ready(function() {
	$(".menu-main-menu-middle-container li").mouseenter(function() {
		$(this).append(
			"<div class='expandable-dropdown-menus-wrapper'>" +
				"<div class='expandable-dropdown-menus'>" +
					"<?php echo $hm_header_one; ?>" +
				"</div>" +
			"</div>");
			//nothing...	
	});
	$(".menu-main-menu-middle-container li").mouseleave(function() {
		$('.expandable-dropdown-menus-wrapper').remove();	
	});

</script>

<?php
}
add_action( "wp_head" , "custom_hover_menu_section" );
?>




