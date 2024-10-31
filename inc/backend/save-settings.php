<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$twp_sfufw_settings = array();

$twp_sfufw_settings[ 'sfufw_product_permalink' ] = isset( $_POST[ 'sfufw_product_permalink' ] ) ? sanitize_text_field( $_POST[ 'sfufw_product_permalink' ] ) : '';
$twp_sfufw_settings[ 'sfufw_product_cat_permalink' ] = isset( $_POST[ 'sfufw_product_cat_permalink' ] ) ? sanitize_text_field( $_POST[ 'sfufw_product_cat_permalink' ] ) : '';
$twp_sfufw_settings[ 'sfufw_product_tag_permalink' ] = isset( $_POST[ 'sfufw_product_tag_permalink' ] ) ? sanitize_text_field( $_POST[ 'sfufw_product_tag_permalink' ] ) : '';
$twp_sfufw_settings[ 'sfufw_ed_canonical' ] = isset( $_POST[ 'sfufw_ed_canonical' ] ) ? sanitize_text_field( $_POST[ 'sfufw_ed_canonical' ] ) : '';
$twp_sfufw_settings[ 'yoast_primary_cat' ] = isset( $_POST[ 'yoast_primary_cat' ] ) ? sanitize_text_field( $_POST[ 'yoast_primary_cat' ] ) : '';
// Update Option.
$status = update_option( 'sfufw_options_settings', $twp_sfufw_settings );
if ( $status == TRUE ) {
    wp_redirect( admin_url() . 'admin.php?page=seo-friendly-urls-for-woocommerce' );
} else {
    wp_redirect( admin_url() . 'admin.php?page=seo-friendly-urls-for-woocommerce' );
}
exit;