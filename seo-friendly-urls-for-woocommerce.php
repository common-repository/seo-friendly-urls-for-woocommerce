<?php
/*
* Plugin Name: SEO-friendly URLs for WooCommerce
* Version: 1.0.1
* Plugin URI: https://www.themeinwp.com/plugin/seo-friendly-urls-for-woocommerce/
* Description: Is your WooCommerce shop URLs SEO friendly? Are you taking advantage of all optimization techniques to maximize the visibility of your online store to search engines? You can create SEO Friendly Product URLs using "SEO-friendly URLs for WooCommerce" - the most advanced and easy to use permalink manager plugin for WooCommerce.
* Author: ThemeInWP
* Author URI: https://www.themeinwp.com/
* Requires at least: 4.5
* Tested up to: 5.5.3
* WC requires at least: 3.0.0
* WC tested up to: 4.7.1
* Text Domain: seo-friendly-urls-for-woocommerce
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'PEFW_LANG_DIR', basename( dirname( __FILE__ ) ) . '/languages/' );
define( 'PEFW_URL', plugin_dir_url( __FILE__ ) );
define( 'PEFW_PATH', plugin_dir_path( __FILE__ ) );
define( 'PEFW_VERSION', '1.0.0' );

 if ( ! class_exists( 'Seo_Friendly_Urls_For_Woocommerce' ) ) {
    
    class Seo_Friendly_Urls_For_Woocommerce{

        function __construct(){

            add_action( 'init', array( $this, 'seo_friendly_urls_for_woocommerce_text_domain' ) );
            register_activation_hook( __FILE__, array( $this, 'seo_friendly_urls_for_woocommerce_plugin_active' ) );
            add_action('admin_post_seo_friendly_urls_for_woocommerce_settings_options', array($this, 'seo_friendly_urls_for_woocommerce_settings_options'));
            add_filter( 'plugin_action_links_'. plugin_basename(__FILE__),array( $this, 'plugin_action_links' ) );
            include_once PEFW_PATH . 'inc/sfufw-enqueue.php';
            include_once PEFW_PATH . 'inc/sfufw-include.php';

            add_action( 'init', array( $this, 'seo_friendly_urls_for_woocommerce_admin_notiece_callback' ) );

        }

        public function seo_friendly_urls_for_woocommerce_admin_notiece_callback(){

            if( !class_exists( 'WooCommerce' ) ){

                if( is_multisite() ){

                  add_action( 'network_admin_notices',array( $this,'seo_friendly_urls_for_woocommerce_admin_notiece' ) );

                } else {

                  add_action( 'admin_notices',array( $this,'seo_friendly_urls_for_woocommerce_admin_notiece' ) );
                }
            }

        }
        public static function seo_friendly_urls_for_woocommerce_admin_notiece(){

            ?>
            <div class="notice notice-error is-dismissible">

                <p>
                    <?php esc_html_e( 'SEO-friendly URLs for WooCommerce is enabled but not effective. It requires ', 'seo-friendly-urls-for-woocommerce' ); ?><a href="<?php echo esc_url( 'https://wordpress.org/plugins/woocommerce/' ); ?>"><?php esc_html_e('Woocommerce','seo-friendly-urls-for-woocommerce'); ?></a><?php esc_html_e( ' in order to work.', 'seo-friendly-urls-for-woocommerce' ); ?>
                </p>

            </div>

        <?php
        }

        public static function plugin_action_links( $links ) {
            $action_links = array(
                'settings' => '<a href="' . admin_url( 'admin.php?page=seo-friendly-urls-for-woocommerce' ) . '">' . esc_html__( 'Settings', 'seo-friendly-urls-for-woocommerce' ) . '</a>',
            );

            return array_merge( $action_links, $links );
        }

        // Update options on theme activate
        function seo_friendly_urls_for_woocommerce_plugin_active(){

            if (empty(get_option('twp_be_options_settings'))) {
                include('inc/backend/activation.php');
            }
            
        }

        function seo_friendly_urls_for_woocommerce_settings_options(){

            if( isset( $_POST['twp_options_nonce'], $_POST['twp_form_submit'] ) && wp_verify_nonce( $_POST['twp_options_nonce'], 'twp_options_nonce' ) && current_user_can('manage_options') ) {
                include('inc/backend/save-settings.php');
            }else{
                die('No script kiddies please!');
            }

        }

        public function seo_friendly_urls_for_woocommerce_text_domain(){
            load_plugin_textdomain( 'seo-friendly-urls-for-woocommerce', false, PEFW_LANG_DIR );
        }

    }

    $GLOBALS[ 'sfufw_global' ] = new Seo_Friendly_Urls_For_Woocommerce();
    
}