<?php


if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

/**
 * WC_Admin class.
 */
class WC_Admin {

	/**
	 * Коснтруктор
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'includes' ) );
		add_action( 'admin_init', array( $this, 'prevent_admin_access' ) );
		add_filter( 'admin_footer_text', array( $this, 'admin_footer_text' ), 1 );
	}

	

	/**
	 * Include any classes we need within admin.
	 */
	public function includes() {
		include_once( dirname( __FILE__ ) . '/wc-admin-functions.php' );
		include_once( dirname( __FILE__ ) . '/wc-meta-box-functions.php' );
		include_once( dirname( __FILE__ ) . '/class-wc-admin-menus.php' );


	}

	

	/**
	 * Доступ только для админов
	 */
	public function prevent_admin_access() {
		$prevent_access = false;

		if ( 'yes' === get_option( '_lock_down_admin', 'yes' ) && ! is_ajax() && basename( $_SERVER["SCRIPT_FILENAME"] ) !== 'admin-post.php' ) {
			$has_cap     = false;
			$access_caps = array( 'edit_posts', 'manage_', 'view_admin_dashboard' );

			foreach ( $access_caps as $access_cap ) {
				if ( current_user_can( $access_cap ) ) {
					$has_cap = true;
					break;
				}
			}

			if ( ! $has_cap ) {
				$prevent_access = true;
			}
		}

		if ( apply_filters( '_prevent_admin_access', $prevent_access ) ) {
			wp_safe_redirect( wc_get_page_permalink( 'myaccount' ) );
			exit;
		}
	}

	
	/**
	 * 
	 * Футер
	 */
	public function admin_footer_text( $footer_text ) {
		if ( ! current_user_can( 'manage_' ) || ! function_exists( 'wc_get_screen_ids' ) ) {
			return $footer_text;
		}
		$current_screen = get_current_screen();
		$wc_pages       = wc_get_screen_ids();

		$wc_pages = array_diff( $wc_pages, array( 'profile', 'user-edit' ) );

		if ( isset( $current_screen->id ) && apply_filters( '_display_admin_footer_text', in_array( $current_screen->id, $wc_pages ) ) ) {
			
			
				$footer_text = __( 'Спасибо за торговлю с MyNewCatalog.', '' );
			
		}

		return $footer_text;
	}


}

return new WC_Admin();
