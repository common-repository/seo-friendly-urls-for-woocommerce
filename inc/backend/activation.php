<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$twp_sfufw_settings = array();
$twp_sfufw_settings[ 'sfufw_product_permalink' ]  = 'woo-setting';
$twp_sfufw_settings[ 'sfufw_product_cat_permalink' ]  = 'cat-woo-setting';
$twp_sfufw_settings[ 'sfufw_ed_canonical' ]  = 0;
$twp_sfufw_settings[ 'yoast_primary_cat' ]  = 1;
update_option( 'sfufw_options_settings', $twp_sfufw_settings );