<?php
/*
* Sale and X REMAINING tags over products
*
*
*/
?>

<?php
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