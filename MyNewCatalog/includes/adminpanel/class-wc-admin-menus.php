<?php
/**
 * Вывод страниц в боковой панели
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( class_exists( 'WC_Admin_Menus', false ) ) {
	return new WC_Admin_Menus();
}

/**
 * WC_Admin_Menus Class.
 */
class WC_Admin_Menus {

	/**
	 * хукки события
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ), 9 );
		

		
	}

	public function admin_menu() {
		global $menu;

		if ( current_user_can( 'manage_' ) ) {
			$menu[] = array( '', 'read', 'separator-', '', 'wp-menu-separator ' ); 
		}

		add_menu_page( __( 'Товары', '' ), __( 'Товары', '' ), 'manage_', '', null, null, '55.5' );

		add_submenu_page( 'array ('Все товары', 'Добавить новый', 'Категории')', __( 'Attributes', '' ), __( 'Attributes', '' ), 'manage_product_terms', 'product_attributes', array( $this, 'attributes_page' ) );
	}

	
		?>
		
}

return new WC_Admin_Menus();
