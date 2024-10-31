<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Included Files
 * @package SEO-friendly URLs for WooCommerce
 *
*/

if( !class_exists('Seo_Friendly_Urls_For_Woocommerce_Include') ):

	class Seo_Friendly_Urls_For_Woocommerce_Include{

		function __construct(){

			add_action('admin_menu', array($this, 'seo_friendly_urls_for_woocommerce_backend_menu'),999);
			include('permalink/permalink.php');
			include('backend/footer.php');

		}

		// Add Backend Menu
        function seo_friendly_urls_for_woocommerce_backend_menu(){

            add_submenu_page('woocommerce','Permalinks', 'Permalinks', 'manage_woocommerce', 'seo-friendly-urls-for-woocommerce', array($this, 'seo_friendly_urls_for_woocommerce_main_page'));

        }

        // Settings Form
        function seo_friendly_urls_for_woocommerce_main_page(){

            include('backend/page.php');

        }

	}

	new Seo_Friendly_Urls_For_Woocommerce_Include();

endif;