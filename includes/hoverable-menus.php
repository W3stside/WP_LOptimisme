<?php
/*
* jQuery hovermenus on Walker Nav Addon
* WP Customizer addon as well
*
*/
?>


<?php
//CUSTOM HOVERABLE MENU HEADER OPTIONS FOR CUSTOMIZER
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
		'default' => 'Shop Livres',
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
		'label' => __( 'Item 1' , 'hm_title' ),
		'section' => 'hm_1_section',
		'type' => 'option',
		'priority' => '5',
		'settings' => 'hm_list_content_1' 
	));

}
?>

<?php
//Adding the hover menu and Customizer ability

add_action ( 'customize_register' , 'custom_hover_menu_editor' );
function custom_hover_menu_section () {
?>	
	<?php
	//Variable for The Loop for the Front Page Menus
	function hover_loop_custom() {
	?>	
		<div class="expandable_dropdown_menus_wrapper">
			<ul class="testis">
					<?php 
					global $product;
				    $args = array( 'post_type' => 'product', 'posts_per_page' => 10, 'product_cat' => 'maison' );
				    $loop = new WP_Query( $args );
				    $class = 'hovermenu-li';
					
					    while ( $loop->have_posts() ) : $loop->the_post();
						 	echo '<li class="'.$class.'"><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
				    	endwhile;
				    
				    wp_reset_query(); ?>
			</ul>
		</div>
	<?php	
	};
	//End The Loop
	?>
<?php
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
		                //<ul> start here
		                '<?php echo hover_loop_custom() ?>'
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