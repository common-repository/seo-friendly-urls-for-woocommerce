<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

 if ( ! class_exists( 'Seo_Friendly_Urls_For_Woocommerce_Footer' ) ) {

    class Seo_Friendly_Urls_For_Woocommerce_Footer{

    	function __construct(){

            add_filter( 'admin_footer_text', array( $this, 'footer_text' ) );

    	}

        public function footer_text( $text ) {

            if ( isset( $_GET['page'] ) && $_GET['page'] == 'seo-friendly-urls-for-woocommerce' ) {


                 $text = esc_html__('If you like using','seo-friendly-urls-for-woocommerce'). '<strong>'.esc_html__(' SEO-friendly URLs for WooCommerce','seo-friendly-urls-for-woocommerce').'</strong>'.esc_html__(', please','seo-friendly-urls-for-woocommerce').' <a href="https://wordpress.org/support/view/plugin-reviews/seo-friendly-urls-for-woocommerce?rate=5#postform" target="_blank">'.esc_html__('leave us a rating','seo-friendly-urls-for-woocommerce').'</a>'.esc_html__('. A ','seo-friendly-urls-for-woocommerce').'<strong>'.esc_html__('huge','seo-friendly-urls-for-woocommerce').'</strong>'.esc_html__(' thank you in advance!','seo-friendly-urls-for-woocommerce');

            }

            return $text;
            
        }

    }

    $GLOBALS[ 'sfufw_global' ] = new Seo_Friendly_Urls_For_Woocommerce_Footer();
    
}