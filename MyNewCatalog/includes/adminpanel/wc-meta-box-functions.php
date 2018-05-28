<?php
/**
 * Функции для мета-бокса моего
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; 

/**
 * Выходные данные из него в виде строк
 */
function woocommerce_wp_text_input( $field ) {
	global $thepostid, $post;

	switch ( $data_type ) {
		case 'price' :
			$field['class'] .= ' wc_input_price';
			$field['value']  = wc_format_localized_price( $field['value'] );
			break;
			break;
	}
	
}
	


/**
 * Входныее данные в виде чекбокса (отзывы)
 *
 */
function woocommerce_wp_checkbox( $field ) {
	global $thepostid, $post;

	$field['desc_tip']      = isset( $field['desc_tip'] ) ? $field['desc_tip'] : false;

	//Включить комменты

	if ( ! empty( $field['description'] ) && false === $field['desc_tip'] ) {
		echo '<span class="description">' . wp_kses_post( $field['description'] ) . '</span>';
	}

	echo '</p>';
}


