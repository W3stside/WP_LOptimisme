<?php
/**
 * Theme Footer Section for our theme.
 *
 * Displays all of the footer section and starting from <footer> tag.
 *
 * @package ThemeGrill
 * @subpackage eStore
 * @since eStore 0.1
 */
?>

	  <footer id="colophon">
		 <?php get_sidebar( 'footer' ); ?>
		 <div id="bottom-footer" class="clearfix">
			<div class="tg-container">
				<?php echo do_shortcode ("[mc4wp_form id='103']") //Newsletter Signup ?>
				<div class="copy-right">
					<?php printf( esc_html__( "Copyright L'Optimisme.com", 'estore' ), 'eStore', '<a href="'.esc_url ( 'http://LOptimisme.com' ).'" rel="designer">Spider Kitty</a>' ); ?>
					<span class="sep"> | </span>
					<?php printf( esc_html__( "L'Optimisme", 'estore' ), '<a href="'.esc_url ( 'https://LOptimisme.com/' ).'">L`Optimisme</a>' ); ?>
				</div>
				<?php
				$logos = array();
				for ( $i = 1; $i < 5; $i++ ) {
					$paymentlogo = get_theme_mod('estore_payment_logo'.$i);
					if($paymentlogo) {
						array_push($logos, $paymentlogo);
					}
				}
				$totallogo = count($logos);
				if($totallogo > 0){ ?>
					<div class="payment-partner-wrapper">
						<ul>
						<?php for($j = 0; $j < $totallogo; $j++ ) { ?>
							<li><img src="<?php echo esc_url($logos[$j])?>" /></li>
						<?php } ?>
						</ul>
					</div>
				<?php } ?>
			</div>
		</div>
	  </footer>
	  <a href="#" class="scrollup"><i class="fa fa-angle-up"> </i> </a>
   </div> <!-- Page end -->
   <?php wp_footer(); ?>
</body>
</html>
