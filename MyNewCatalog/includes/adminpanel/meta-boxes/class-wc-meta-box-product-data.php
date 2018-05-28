<?php
/**
 * 
 * Мета бокс с ценой и отзывом
 * 

 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WC_Meta_Box_Product_Data {

	public static function output( $post ) {
		global $thepostid, $product_object;

		$thepostid      = $post->ID;
		$product_object = $thepostid ? wc_get_product( $thepostid ) : new WC_Product;

		wp_nonce_field( '_save_data', '_meta_nonce' );

		include( 'views/html-product-data-panel.php' );
	}

	/**
	 * Подключить вкладку основные
	 */
	private static function output_tabs() {
		global $post, $thepostid, $product_object;

		include( 'views/html-product-data-general.php' );
	}


	/**
	 * Отображать основные
	 */
	private static function get_product_data_tabs() {
		$tabs = apply_filters( '_product_data_tabs', array(
			'general' => array(
				'label'    => __( 'General', '' ),
				'target'   => 'general_product_data',
				'class'    => array( 'hide_if_grouped' ),
				'priority' => 10,
			),
		) );

	

		return $tabs;
	}

	/**
	 * Сохранить данные с бокса
	 */
	public static function save( $post_id, $post ) {
		
		$product_type = empty( $_POST['product-type'] ) ? WC_Product_Factory::get_product_type( $post_id ) : sanitize_title( stripslashes( $_POST['product-type'] ) );
		$classname    = WC_Product_Factory::get_product_classname( $post_id, $product_type ? $product_type : 'simple' );
		$product      = new $classname( $post_id );
		$attributes   = self::prepare_attributes();
		$stock        = null;

		
		if ( isset( $_POST['_stock'] ) ) {
			if ( isset( $_POST['_original_stock'] ) && wc_stock_amount( $product->get_stock_quantity( 'edit' ) ) !== wc_stock_amount( $_POST['_original_stock'] ) ) {
				
				WC_Admin_Meta_Boxes::add_error( sprintf( __( 'Ошибка сохранения', '' ), $product->get_id(), $product->get_stock_quantity( 'edit' ) ) );
			} else {
				$stock = wc_stock_amount( $_POST['_stock'] );
			}
		}

		$errors       = $product->set_props( array(
			'regular_price'      => wc_clean( $_POST['_regular_price'] ), //Стоимость
			'reviews_allowed'    => ! empty( $_POST['comment_status'] ) && 'open' === $_POST['comment_status'], //Отзывы +/-

		) );

		if ( is_wp_error( $errors ) ) {
			WC_Admin_Meta_Boxes::add_error( $errors->get_error_message() );
		}

		
		do_action( '_admin_process_product_object', $product );

		$product->save();


		do_action( '_process_product_meta_' . $product_type, $post_id );
	}

	
}
