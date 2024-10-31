<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Enqueue Scripts and Styles
 * @package SEO-friendly URLs for WooCommerce
 *
*/

if( !class_exists('Seo_Friendly_Urls_For_Woocommerce_Enqueue') ):

	class Seo_Friendly_Urls_For_Woocommerce_Enqueue{

		function __construct(){

			add_action( 'admin_enqueue_scripts',array( $this,'seo_friendly_urls_for_woocommerce_backend_scripts' ) );

		}


		/**
		 * Style and scripts load for Backends
		**/
		public function seo_friendly_urls_for_woocommerce_backend_scripts(){

			wp_enqueue_style( 'seo-friendly-urls-for-woocommerce-admin', PEFW_URL . 'assets/css/admin.css' );
			wp_enqueue_script( 'seo-friendly-urls-for-woocommerce-admin', PEFW_URL . 'assets/js/admin.js', array('jquery'), true );

		}

	}

	new Seo_Friendly_Urls_For_Woocommerce_Enqueue();
	
endif;