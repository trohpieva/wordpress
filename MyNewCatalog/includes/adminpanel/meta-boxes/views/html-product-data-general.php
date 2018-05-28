<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div id="general_product_data" class="panel options_panel">

<?php if ( post_type_supports( 'product', 'comments' ) ) : ?>


		<div class="options_group reviews">
			<?php
				woocommerce_wp_checkbox( array(
					'id'      => 'comment_status',
					'value'   => $product_object->get_reviews_allowed( 'edit' ) ? 'open' : 'closed',
					'label'   => __( 'Enable reviews'),
					'cbvalue' => 'open',
				) );
				do_action( 'product_options_reviews' );
			?>
		</div>
	<?php endif; ?>
	
	
	<div class="options_group show_if_external">
		<?php
			wp_text_input( array(
				'id'        => '_regular_price',
				'value'     => $product_object->get_regular_price( 'edit' ),
				'label'     => __( 'Regular price') . ' (' . get_currency_symbol() . ')',
				'data_type' => 'price',
			) );

			

			do_action( 'product_options_pricing' );
		?>
	</div>

	

	<?php do_action( 'product_options_general_product_data' ); ?>
</div>
