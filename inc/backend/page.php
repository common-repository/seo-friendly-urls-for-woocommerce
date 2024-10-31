<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Settings Widgets.
 *
 * @package SEO-friendly URLs for WooCommerce
**/

$twp_sfufw_settings = get_option( 'sfufw_options_settings' );
$info_premium = esc_html__('Available on Premium Version','seo-friendly-urls-for-woocommerce');
?>
<div>

    <div id="expert-admin" class="wrap expert-settings">
        <div class="breadcrumbs">
            <span class="prefix"><?php esc_html_e('You are here:','seo-friendly-urls-for-woocommerce'); ?> </span>
            <span class="current-crumb"><strong><?php esc_html_e('SEO-friendly URLs for WooCommerce','seo-friendly-urls-for-woocommerce'); ?></strong></span>
        </div>
        <div class="expert-dashboard">
            <div class="expert-wrapper">
                <div class="expert-wrapper-inner">
                    <div class="expert-column expert-column-8">

                        <header class="expert-header">
                            <h1 class="expert-title expert-title-big"><?php esc_html_e('SEO-friendly URLs for WooCommerce: options','seo-friendly-urls-for-woocommerce'); ?></h1>
                            <p class="expert-description"><?php esc_html_e('SEO-friendly URLs for WooCommerce is a most advanced and easy to use permalink manager plugin that helps WordPress users to create a custom URL structure for your WooCommerce permalinks.','seo-friendly-urls-for-woocommerce'); ?></p>

                            <?php
                            $structure = get_option( 'permalink_structure' );
                            if( empty( $structure ) ){ ?>

                                <div id="setting-error-sfufw" class="notice notice-warning settings-error is-dismissible">
                                    <p>
                                        <?php
                                        esc_html_e('Plain option is selected under Common Settings. SEO-friendly URLs for WooCommerce requires this option to be changed. Please ','seo-friendly-urls-for-woocommerce');
                                        echo '<a href="'.esc_url( home_url('/') .'wp-admin/options-permalink.php' ).'">';
                                        esc_html_e('click here','seo-friendly-urls-for-woocommerce');
                                        echo '</a>';
                                        esc_html_e(' to change the setting.','seo-friendly-urls-for-woocommerce'); ?>
                                    </p>
                                </div>

                            <?php } ?>
                        </header>

                        <form class="sfufw-plugin-settings-form" method="post" action="<?php echo esc_url( admin_url() . 'admin-post.php' )?>">

                            <input type="hidden" name="action" value="seo_friendly_urls_for_woocommerce_settings_options" />


                            <div class="expert-plugin-panel">

                                <h2><?php esc_html_e('Products option','seo-friendly-urls-for-woocommerce'); ?></h2>

                                <?php
                                $sfufw_product_permalink = isset( $twp_sfufw_settings[ 'sfufw_product_permalink' ] ) ? $twp_sfufw_settings[ 'sfufw_product_permalink' ] : '';
                                ?>

                                <div class="expert-plugin-option">
                                    <div class="expert-wrapper">
                                        <div class="expert-wrapper-inner">
                                            <div class="expert-column expert-column-4">
                                                <div class="sfufw-radio-wrap">
                                                    <input <?php if( empty( $structure ) ){ echo 'disabled="disabled"'; } ?> id="sfufw-product-settings-default" type="radio" name="sfufw_product_permalink" value="woo-setting" <?php if( empty( $structure ) || $sfufw_product_permalink == 'woo-setting' || $sfufw_product_permalink == '' ){ echo 'checked'; } ?>>
                                                    <label class="sfufw-radio" for="sfufw-product-settings-default" ><?php esc_html_e('Default WooCommerce option','seo-friendly-urls-for-woocommerce'); ?></label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="expert-plugin-option">
                                    <div class="expert-wrapper">
                                        <div class="expert-wrapper-inner">
                                            <div class="expert-column expert-column-4">
                                                <div class="sfufw-radio-wrap">
                                                    <input <?php if( empty( $structure ) ){ echo 'disabled="disabled"'; }?> id="sfufw-product-settings-variation-3" type="radio" name="sfufw_product_permalink" value="product-slug" <?php if( !empty( $structure ) && $sfufw_product_permalink == 'product-slug' ){ echo 'checked'; } ?>>
                                                    <label for="sfufw-product-settings-variation-3" class="sfufw-radio"><?php esc_html_e('Product slug only','seo-friendly-urls-for-woocommerce'); ?></label>
                                                </div>
                                            </div>
                                            <div class="expert-column expert-column-8">
                                               <code><?php echo esc_url( home_url('/').'product/' ); ?></code>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="expert-plugin-option">
                                    <div class="expert-wrapper">
                                        <div class="expert-wrapper-inner">
                                            <div class="expert-column expert-column-4">
                                                <div class="sfufw-radio-wrap">
                                                    <input <?php if( empty( $structure ) ){ echo 'disabled="disabled"'; }?> id="sfufw-product-settings-variation-1" type="radio" name="sfufw_product_permalink" value="primary-category" <?php if( !empty( $structure ) && $sfufw_product_permalink == 'primary-category' ){ echo 'checked'; } ?>>
                                                    <label for="sfufw-product-settings-variation-1" class="sfufw-radio"><?php esc_html_e('Product slug with primary category','seo-friendly-urls-for-woocommerce'); ?></label>
                                                </div>
                                            </div>
                                            <div class="expert-column expert-column-8">
                                               <code><?php echo esc_url( home_url('/').'parent-category/product/' ); ?></code>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <div class="expert-plugin-option">
                                    <div class="expert-wrapper">
                                        <div class="expert-wrapper-inner">
                                            <div class="expert-column expert-column-4">
                                                <div class="sfufw-radio-wrap">
                                                    <input <?php if( empty( $structure ) ){ echo 'disabled="disabled"'; }?> id="sfufw-product-settings-variation-2" type="radio" name="sfufw_product_permalink" value="full-path" <?php if( !empty( $structure ) && $sfufw_product_permalink == 'full-path' ){ echo 'checked'; } ?>>
                                                    <label for="sfufw-product-settings-variation-2" class="sfufw-radio"><?php esc_html_e('Full product path','seo-friendly-urls-for-woocommerce'); ?></label>
                                                </div>
                                            </div>
                                            <div class="expert-column expert-column-8">
                                               <code><?php echo esc_url( home_url('/').'parent-category/sub-category/product/' ); ?></code>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="expert-plugin-panel">

                                <h2><?php esc_html_e('Categories option','seo-friendly-urls-for-woocommerce'); ?></h2>

                                <?php
                                $sfufw_product_cat_permalink = isset( $twp_sfufw_settings[ 'sfufw_product_cat_permalink' ] ) ? $twp_sfufw_settings[ 'sfufw_product_cat_permalink' ] : '';
                                ?>

                                <div class="expert-plugin-option">
                                    <div class="expert-wrapper">
                                        <div class="expert-wrapper-inner">
                                            <div class="expert-column expert-column-4">
                                                <div class="sfufw-radio-wrap">
                                                    <input <?php if( empty( $structure ) ){ echo 'disabled="disabled"'; }?> id="sfufw-category-settings-default" type="radio" name="sfufw_product_cat_permalink" value="cat-woo-setting" <?php if( empty( $structure ) || $sfufw_product_cat_permalink == 'cat-woo-setting' || $sfufw_product_cat_permalink == '' ){ echo 'checked'; } ?>>
                                                    <label for="sfufw-category-settings-default" class="sfufw-radio"><?php esc_html_e('Default WooCommerce option','seo-friendly-urls-for-woocommerce'); ?></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="expert-plugin-option">
                                    <div class="expert-wrapper">
                                        <div class="expert-wrapper-inner">
                                            <div class="expert-column expert-column-4">
                                                <div class="sfufw-radio-wrap">
                                                    <input <?php if( empty( $structure ) ){ echo 'disabled="disabled"'; }?> id="sfufw-category-settings-variation-1" type="radio" name="sfufw_product_cat_permalink" value="cat-slug" <?php if( !empty( $structure ) && $sfufw_product_cat_permalink == 'cat-slug' ){ echo 'checked'; } ?>>
                                                    <label for="sfufw-category-settings-variation-1" class="sfufw-radio"><?php esc_html_e('Category slug only','seo-friendly-urls-for-woocommerce'); ?></label>
                                                </div>
                                            </div>
                                            <div class="expert-column expert-column-8">
                                                <code><?php echo esc_url( home_url('/').'category/' ); ?></code>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="expert-plugin-option">
                                    <div class="expert-wrapper">
                                        <div class="expert-wrapper-inner">
                                            <div class="expert-column expert-column-4">
                                                <div class="sfufw-radio-wrap">
                                                    <input <?php if( empty( $structure ) ){ echo 'disabled="disabled"'; }?> id="sfufw-category-settings-variation-2" type="radio" name="sfufw_product_cat_permalink" value="cat-full-slug" <?php if( !empty( $structure ) && $sfufw_product_cat_permalink == 'cat-full-slug' ){ echo 'checked'; } ?>>
                                                    <label for="sfufw-category-settings-variation-2" class="sfufw-radio"><?php esc_html_e('Full category path','seo-friendly-urls-for-woocommerce'); ?></label>
                                                </div>
                                            </div>
                                            <div class="expert-column expert-column-8">
                                                <code><?php echo esc_url( home_url('/').'category/sub-category/' ); ?></code>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="expert-plugin-panel">

                                <h2><?php esc_html_e('Tags  option','seo-friendly-urls-for-woocommerce'); ?></h2>

                                <?php
                                $sfufw_product_tag_permalink = isset( $twp_sfufw_settings[ 'sfufw_product_tag_permalink' ] ) ? $twp_sfufw_settings[ 'sfufw_product_tag_permalink' ] : '';
                                ?>

                                <div class="expert-plugin-option">
                                    <div class="expert-wrapper">
                                        <div class="expert-wrapper-inner">
                                            <div class="expert-column expert-column-4">
                                                <div class="sfufw-radio-wrap">
                                                    <input <?php if( empty( $structure ) ){ echo 'disabled="disabled"'; }?> id="sfufw-tag-settings-default" type="radio" name="sfufw_product_tag_permalink" value="tag-woo-setting" <?php if( empty( $structure ) || $sfufw_product_tag_permalink == 'tag-woo-setting' || $sfufw_product_tag_permalink == '' ){ echo 'checked'; } ?>>
                                                    <label for="sfufw-tag-settings-default" class="sfufw-radio"><?php esc_html_e('Default WooCommerce option','seo-friendly-urls-for-woocommerce'); ?></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="expert-plugin-option">
                                    <div class="expert-wrapper">
                                        <div class="expert-wrapper-inner">
                                            <div class="expert-column expert-column-4">
                                                <div class="sfufw-radio-wrap">
                                                    <input <?php if( empty( $structure ) ){ echo 'disabled="disabled"'; }?> id="sfufw-tag-settings-variation-1" type="radio" name="sfufw_product_tag_permalink" value="tag-slug" <?php if( !empty( $structure ) && $sfufw_product_tag_permalink == 'tag-slug' ){ echo 'checked'; } ?>>
                                                    <label for="sfufw-tag-settings-variation-1" class="sfufw-radio"><?php esc_html_e('Tag slug Only','seo-friendly-urls-for-woocommerce'); ?></label>
                                                </div>
                                            </div>
                                            <div class="expert-column expert-column-8">
                                                <code><?php echo esc_url( home_url('/').'tag/' ); ?></code>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="expert-plugin-panel">

                                <h2><?php esc_html_e('URL\'s suffix option','seo-friendly-urls-for-woocommerce'); ?></h2>

                                <div class="expert-plugin-option">
                                    <div class="expert-wrapper">
                                        <div class="expert-wrapper-inner">
                                            <div class="expert-column expert-column-4 sfufw-input-wraper">
                                                <input  type="text" disabled>
                                                <label class="sfufw-option-info"><?php esc_html_e('Specify suffix for your urls. For example .html','seo-friendly-urls-for-woocommerce'); ?></label>
                                            </div>

                                        </div>

                                        <strong class="pro-feature-info">
                                            <?php echo $info_premium; ?>
                                        </strong>

                                    </div>
                                </div>

                                <div class="expert-plugin-option">
                                    <div class="expert-wrapper">
                                        <div class="expert-wrapper-inner">

                                            <div class="expert-column expert-column-4">
                                                <div class="sfufw-checkbox-wraper">
                                                    <input id="sfufw-suffix-settings-variation-1" type="checkbox" disabled>
                                                    <label class="sfufw-checkbox-label" for="sfufw-suffix-settings-variation-1">
                                                        <span class="sfufw-checkmark-icon"></span>
                                                        <span class="sfufw-checkmark-info"><?php esc_html_e('Click to enable URL\'s suffix for products','seo-friendly-urls-for-woocommerce'); ?></span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="expert-column expert-column-8">
                                                <code><?php echo esc_url( home_url('/').'product/slug' ); ?></code>
                                            </div>

                                            <div class="expert-column expert-column-12">
                                                <strong class="pro-feature-info">
                                                    <?php echo $info_premium; ?>
                                                </strong>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                                <div class="expert-plugin-option">
                                    <div class="expert-wrapper">
                                        <div class="expert-wrapper-inner">

                                            <div class="expert-column expert-column-4">
                                                <div class="sfufw-checkbox-wraper">
                                                    <input id="sfufw-suffix-settings-variation-2" type="checkbox" disabled>
                                                    <label class="sfufw-checkbox-label" for="sfufw-suffix-settings-variation-2">
                                                        <span class="sfufw-checkmark-icon"></span>
                                                        <span class="sfufw-checkmark-info"><?php esc_html_e('Click to enable URL\'s suffix for categories','seo-friendly-urls-for-woocommerce'); ?></span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="expert-column expert-column-8">
                                                <code><?php echo esc_url( home_url('/').'category/slug' ); ?></code>
                                            </div>

                                            <div class="expert-column expert-column-12">
                                                <strong class="pro-feature-info">
                                                    <?php echo $info_premium; ?>
                                                </strong>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="expert-plugin-option">
                                    <div class="expert-wrapper">
                                        <div class="expert-wrapper-inner">
                                            
                                            <div class="expert-column expert-column-4">
                                                <div class="sfufw-checkbox-wraper">
                                                    <input id="sfufw-suffix-settings-variation-3" type="checkbox"disabled>
                                                    <label class="sfufw-checkbox-label" for="sfufw-suffix-settings-variation-3">
                                                        <span class="sfufw-checkmark-icon"></span>
                                                        <span class="sfufw-checkmark-info"><?php esc_html_e('Click to enable URL\'s suffix for tags','seo-friendly-urls-for-woocommerce'); ?></span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="expert-column expert-column-8">
                                                <code><?php echo esc_url( home_url('/').'tag/slug' ); ?></code>
                                            </div>

                                            <div class="expert-column expert-column-12">
                                                <strong class="pro-feature-info">
                                                    <?php echo $info_premium; ?>
                                                </strong>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div class="expert-plugin-panel">

                                <h2><?php esc_html_e('Additional options','seo-friendly-urls-for-woocommerce'); ?></h2>

                                <?php
                                $sfufw_ed_canonical = isset( $twp_sfufw_settings[ 'sfufw_ed_canonical' ] ) ? $twp_sfufw_settings[ 'sfufw_ed_canonical' ] : '';
                                ?>

                                <div class="expert-plugin-option">
                                    <div class="expert-wrapper">
                                        <div class="expert-wrapper-inner">
                                            <div class="expert-column expert-column-8">
                                                <div class="sfufw-checkbox-wraper">
                                                    <input <?php if( empty( $structure ) ){ echo 'disabled="disabled"'; }?> id="sfufw-ed-canonical" type="checkbox" name="sfufw_ed_canonical" value="1" <?php if( !empty( $structure ) && $sfufw_ed_canonical ){ echo 'checked'; } ?>>
                                                    <label class="sfufw-checkbox-label" for="sfufw-ed-canonical">
                                                        <span class="sfufw-checkmark-icon"></span>
                                                        <span class="sfufw-checkmark-info"><?php esc_html_e('Click to enable canonical meta tag to duplicated pages','seo-friendly-urls-for-woocommerce'); ?></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                $yoast_primary_cat = isset( $twp_sfufw_settings[ 'yoast_primary_cat' ] ) ? $twp_sfufw_settings[ 'yoast_primary_cat' ] : '';
                                ?>

                                <div class="expert-plugin-option">
                                    <div class="expert-wrapper">
                                        <div class="expert-wrapper-inner">
                                            <div class="expert-column expert-column-8">
                                                <div class="sfufw-checkbox-wraper">
                                                    <input <?php if( empty( $structure ) ){ echo 'disabled="disabled"'; }?> id="yoast-primary-cat" type="checkbox" name="yoast_primary_cat" value="1" <?php if( !empty( $structure ) && $yoast_primary_cat ){ echo 'checked'; } ?>>
                                                    <label class="sfufw-checkbox-label" for="yoast-primary-cat">
                                                        <span class="sfufw-checkmark-icon"></span>
                                                        <span class="sfufw-checkmark-info"><?php esc_html_e('Click to enable Yoast SEO\'s primary category to build product path','seo-friendly-urls-for-woocommerce'); ?></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <?php /** Nonce Action **/
                            wp_nonce_field('twp_options_nonce', 'twp_options_nonce'); ?>
                            <input type="submit" class="twp-button button-primary" value="<?php esc_html_e('Save Settings','seo-friendly-urls-for-woocommerce'); ?>" id="twp_form_submit" name="twp_form_submit"/>

                        </form>

                    </div>
                    <div class="expert-column expert-column-4">
                        <div class="expert-sidebar">
                            <h4 class="expert-title expert-title-medium"><?php esc_html_e('Looking for help?','seo-friendly-urls-for-woocommerce'); ?></h4>
                            <p><?php esc_html_e('We have some resources available to help you in the right direction.','seo-friendly-urls-for-woocommerce'); ?></p>
                            <ul class="ul-square">
                                <li><a href=""><?php esc_html_e('Knowledge Base','seo-friendly-urls-for-woocommerce'); ?></a></li>
                                <li><a href=""><?php esc_html_e('Frequently Asked Questions','seo-friendly-urls-for-woocommerce'); ?></a></li>
                            </ul>
                            <p><?php esc_html_e('Frequently Asked QuestionsIf your answer can not be found in the resources listed above, please create a support ticket','seo-friendly-urls-for-woocommerce'); ?> <a href=""><?php esc_html_e('here','seo-friendly-urls-for-woocommerce'); ?></a>.</p>
                            <p><?php esc_html_e('Found a bug? Please','seo-friendly-urls-for-woocommerce'); ?> <a href=""><?php esc_html_e('open an issue on GitHub','seo-friendly-urls-for-woocommerce'); ?></a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>