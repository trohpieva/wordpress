<?php
/**
 *
 * В панели аминистратора страницы заполняются мета боксами
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * WC_Admin_Meta_Boxes.
 */
class WC_Admin_Meta_Boxes {


	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'remove_meta_boxes' ), 10 );
		add_action( 'add_meta_boxes', array( $this, 'rename_meta_boxes' ), 20 );
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ), 30 );
		add_action( 'save_post', array( $this, 'save_meta_boxes' ), 1, 2 );

		/**
		 * Сохранить метабоксы
		 *
		 */
		
		

		// Сохранить товар
		add_action( '_process_product_meta', 'WC_Meta_Box_Product_Data::save', 10, 2 );
		add_action( '_process_product_meta', 'WC_Meta_Box_Product_Images::save', 20, 2 );

	
	}

	/**
	 * Add WC Meta boxes.
	 */
	public function add_meta_boxes() {
		$screen    = get_current_screen();
		$screen_id = $screen ? $screen->id : '';

		// Products.
		add_meta_box( 'postexcerpt', __( 'Product short description', '' ), 'WC_Meta_Box_Product_Short_Description::output', 'product', 'normal' );
		add_meta_box( '-product-data', __( 'Product data', '' ), 'WC_Meta_Box_Product_Data::output', 'product', 'normal', 'high' );
		add_meta_box( '-product-images', __( 'Product gallery', '' ), 'WC_Meta_Box_Product_Images::output', 'product', 'side', 'low' );

		// Orders.
		foreach ( wc_get_order_types( 'order-meta-boxes' ) as $type ) {
			$order_type_object = get_post_type_object( $type );
			add_meta_box( '-order-data', sprintf( __( '%s data', '' ), $order_type_object->labels->singular_name ), 'WC_Meta_Box_Order_Data::output', $type, 'normal', 'high' );
			add_meta_box( '-order-items', __( 'Items', '' ), 'WC_Meta_Box_Order_Items::output', $type, 'normal', 'high' );
			add_meta_box( '-order-notes', sprintf( __( '%s notes', '' ), $order_type_object->labels->singular_name ), 'WC_Meta_Box_Order_Notes::output', $type, 'side', 'default' );
			add_meta_box( '-order-downloads', __( 'Downloadable product permissions', '' ) . wc_help_tip( __( 'Note: Permissions for order items will automatically be granted when the order status changes to processing/completed.', '' ) ), 'WC_Meta_Box_Order_Downloads::output', $type, 'normal', 'default' );
			add_meta_box( '-order-actions', sprintf( __( '%s actions', '' ), $order_type_object->labels->singular_name ), 'WC_Meta_Box_Order_Actions::output', $type, 'side', 'high' );
		}

		

		// Возможность комментить
		if ( 'comment' === $screen_id && isset( $_GET['c'] ) && metadata_exists( 'comment', $_GET['c'], 'rating' ) ) {
			add_meta_box( '-rating', __( 'Rating', '' ), 'WC_Meta_Box_Product_Reviews::output', 'comment', 'normal', 'high' );
		}
	}

	/**
	 * Удалить лишнее
	 */
	public function remove_meta_boxes() {
		remove_meta_box( 'postexcerpt', 'product', 'normal' );
		remove_meta_box( 'product_shipping_classdiv', 'product', 'side' );
		remove_meta_box( 'commentsdiv', 'product', 'normal' );
		remove_meta_box( 'commentstatusdiv', 'product', 'side' );
		remove_meta_box( 'commentstatusdiv', 'product', 'normal' );
		remove_meta_box( 'woothemes-settings', 'shop_coupon', 'normal' );
		remove_meta_box( 'commentstatusdiv', 'shop_coupon', 'normal' );
		remove_meta_box( 'slugdiv', 'shop_coupon', 'normal' );

		
	}

	

	/**
	 * Сохранить
	 */
	public function save_meta_boxes( $post_id, $post ) {
		// $post_id and $post are required
		if ( empty( $post_id ) || empty( $post ) || self::$saved_meta_boxes ) {
			return;
		}

		
		
}

new WC_Admin_Meta_Boxes();
