<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

 if ( ! class_exists( 'Seo_Friendly_Urls_For_Woocommerce_Permalink_Replace' ) ) {

    class Seo_Friendly_Urls_For_Woocommerce_Permalink_Replace{

    	function __construct(){

            add_filter( 'post_type_link',array( $this, 'replace_product_link' ),1,2 );
            add_filter( 'term_link',array( $this, 'replace_product_cat' ),0,3);
            add_action( 'wp_loaded', array( $this,'wp_loaded_rewrite_rules' ) );
            add_filter( 'rewrite_rules_array', array( $this,'term_rewrite_rules' ),99 );
            add_filter( 'request', [ $this, 'replace_product_link_request' ], 11 );

    	}

        function wp_loaded_rewrite_rules( $rules ) {

            $rules = get_option( 'rewrite_rules' );

            if ( ! isset( $rules['(seller-login)/(.+)$'] ) ) {
                global $wp_rewrite;
                $wp_rewrite->flush_rules();
            }

        }

        public function term_rewrite_rules( $rules ){

            $structure = get_option( 'permalink_structure' );
            if( empty( $structure ) ){
                return $rules;
            }

            $twp_sfufw_settings = get_option( 'sfufw_options_settings' );
            $cat_link_type = isset( $twp_sfufw_settings[ 'sfufw_product_cat_permalink' ] ) ? $twp_sfufw_settings[ 'sfufw_product_cat_permalink' ] : '';
            $tag_link_type = isset( $twp_sfufw_settings[ 'sfufw_product_tag_permalink' ] ) ? $twp_sfufw_settings[ 'sfufw_product_tag_permalink' ] : '';

            $tax_array = array();

            if( $cat_link_type == 'cat-slug' ){
                $tax_array['product_cat'] = 'slug';
            }else{
                $tax_array['product_cat'] = 'hierarchical';
            }

            if( $tag_link_type == 'tag-slug' ){
                $tax_array['product_tag'] = 'slug';
            }else{
                $tax_array['product_tag'] = '';
            }

            if ( empty($tax_array) ) {
                return $rules;
            }

            wp_cache_flush();
            global  $wp_rewrite ;
            $feed = '(' . trim( implode( '|', $wp_rewrite->feeds ) ) . ')';
            $rewrite_rule = [];
            
            foreach ( $tax_array as $taxonomy => $option ) {
                
                if ( !empty($option) ) {

                    $terms = get_categories( [
                        'taxonomy'   => $taxonomy,
                        'hide_empty' => false,
                    ] );

                    $twp_sfufw_settings = get_option( 'sfufw_options_settings' );
                    $cat_link_type = isset( $twp_sfufw_settings[ 'sfufw_product_cat_permalink' ] ) ? $twp_sfufw_settings[ 'sfufw_product_cat_permalink' ] : '';

                    if( $cat_link_type == 'cat-slug' ){
                        $hierarchical = '';
                    }else{
                        $hierarchical = true;
                    }

                    $suffix = '';

                    foreach ( $terms as $term ) {

                        $slug = $this->create_link_path( $term, $hierarchical, $suffix );
                        $rewrite_rule["{$slug}/?\$"] = 'index.php?' . $taxonomy . '=' . $term->slug;
                        $rewrite_rule["{$slug}/embed/?\$"] = 'index.php?' . $taxonomy . '=' . $term->slug . '&embed=true';
                        $rewrite_rule["{$slug}/{$wp_rewrite->feed_base}/{$feed}/?\$"] = 'index.php?' . $taxonomy . '=' . $term->slug . '&feed=$matches[1]';
                        $rewrite_rule["{$slug}/{$feed}/?\$"] = 'index.php?' . $taxonomy . '=' . $term->slug . '&feed=$matches[1]';
                        $rewrite_rule["{$slug}/{$wp_rewrite->pagination_base}/?([0-9]{1,})/?\$"] = 'index.php?' . $taxonomy . '=' . $term->slug . '&paged=$matches[1]';

                    }

                }
            
            }
            
            return $rewrite_rule + $rules;

        }

        public function replace_product_cat( $url, $term, $taxonomy ){

            $twp_sfufw_settings = get_option( 'sfufw_options_settings' );
            $cat_link_type = isset( $twp_sfufw_settings[ 'sfufw_product_cat_permalink' ] ) ? $twp_sfufw_settings[ 'sfufw_product_cat_permalink' ] : '';
            $tag_link_type = isset( $twp_sfufw_settings[ 'sfufw_product_tag_permalink' ] ) ? $twp_sfufw_settings[ 'sfufw_product_tag_permalink' ] : '';
            $sfufw_ed_canonical = isset( $twp_sfufw_settings[ 'sfufw_ed_canonical' ] ) ? $twp_sfufw_settings[ 'sfufw_ed_canonical' ] : '';
            $structure = get_option( 'permalink_structure' );
            if( empty( $structure ) ){
                return $url;
            }
            if ( $taxonomy != 'product_cat' && $taxonomy != 'product_tag' ) {
                if( $sfufw_ed_canonical ){
                    update_option('canonical_link',$url);
                    add_action( 'wp_head', array( $this,'canonical_meta' ),100 );
                }
                return $url;
            }

            if ( $taxonomy == 'product_cat' && $cat_link_type == 'cat-woo-setting' ) {
                if( $sfufw_ed_canonical ){
                    update_option('canonical_link',$url);
                    add_action( 'wp_head', array( $this,'canonical_meta' ),100 );
                }
                return $url;
            }

            if ( $taxonomy == 'product_tag' && $tag_link_type == 'tag-woo-setting' ) {
                if( $sfufw_ed_canonical ){
                    update_option('canonical_link',$url);
                    add_action( 'wp_head', array( $this,'canonical_meta' ),100 );
                }
                return $url;
            }

            $suffix = '';
            if ( $taxonomy == 'product_cat' ) {

                if( $cat_link_type == 'cat-slug' ){
                    $status = false;
                }else{
                    $status = true;
                }

            }

            if ( $taxonomy == 'product_tag' ) {

                if( $cat_link_type == 'tag-slug' ){
                    $status = false;
                }else{
                    $status = true;
                }

            }
            
            $path = $this->create_link_path( $term, $status, $suffix );

            if( $url ){
                $url = home_url( $path );
            }else{
                $url = home_url( user_trailingslashit( $path ) );
            }

            if( $sfufw_ed_canonical ){
                update_option('canonical_link',$url);
                add_action( 'wp_head', array( $this,'canonical_meta' ),100 );
            }

            return $url;

        }

        function canonical_meta( $rules ) {

            ?><meta rel="canonical" href="<?php echo esc_url( get_option('canonical_link') ); ?>"><?php

        }

        private function create_link_path( $term, $status, $suffix = false ){
            
            $slug = urldecode( $term->slug );
            
            if ( $status && $term->parent ) {
                $ancestors = get_ancestors( $term->term_id, 'product_cat' );
                foreach ( $ancestors as $ancestor ) {
                    $ancestor_content = get_term( $ancestor, 'product_cat' );
                    $slug = urldecode( $ancestor_content->slug ) . '/' . $slug;
                }
            }

            if ( $status && $term->parent ) {
                $ancestors = get_ancestors( $term->term_id, 'product_tag' );
                foreach ( $ancestors as $ancestor ) {
                    $ancestor_content = get_term( $ancestor, 'product_tag' );
                    $slug = urldecode( $ancestor_content->slug ) . '/' . $slug;
                }
            }
            
            return ( $suffix ? $slug . $suffix : $slug );

        }

        public function replace_product_link( $permalink, $post ){

            $structure = get_option( 'permalink_structure' );
            if( empty( $structure ) ){
                return $permalink;
            }

            global $post;

            $twp_sfufw_settings = get_option( 'sfufw_options_settings' );
            $url_type = isset( $twp_sfufw_settings[ 'sfufw_product_permalink' ] ) ? $twp_sfufw_settings[ 'sfufw_product_permalink' ] : '';
            $yoast_primary_cat = isset( $twp_sfufw_settings[ 'yoast_primary_cat' ] ) ? $twp_sfufw_settings[ 'yoast_primary_cat' ] : '';
            $twp_sfufw_settings = get_option( 'sfufw_options_settings' );

            if ( $post->post_type != 'product' ) {
                return $permalink;
            }

            $permalinkStructure = wc_get_permalink_structure();
            $product_base = $permalinkStructure['product_rewrite_slug'];
            $taxonomy = 'product_cat'; 
            $primary_cat_id = get_post_meta(get_the_ID(),'_yoast_wpseo_primary_' . $taxonomy, true);
            if($primary_cat_id){
               $primary_cat = get_term($primary_cat_id, $taxonomy);
            }
            

            $terms = get_the_terms( get_the_ID(),'product_cat' );
            if( strpos($product_base,'product_cat') ){

                if( $terms && $url_type == 'product-slug' ){

                    foreach( $terms as $term ){
                        $slug = $term->slug;

                        if( strpos($permalink,$slug) ){

                            $permalink = str_replace($slug.'/','',$permalink);

                            if( isset( $term->parent ) && $term->parent != 0 ){
                                $pterm = get_term_by('id',$term->parent,'product_cat');
                                $permalink = str_replace($pterm->slug.'/','',$permalink);
                            }

                        }

                    }

                    $product_base = str_replace( '%product_cat%','', $product_base );
                    $permalink = str_replace( '%product_cat%/','', $permalink );
                    $url = str_replace( $product_base, '/', $permalink );

                }elseif( $terms && $url_type == 'primary-category' ){

                    $array_cat = array();
                    foreach ( $terms as $term ){
                        if ( $term->parent == 0 ) {
                            $array_cat[$term->slug] = $term->term_id;
                        }
                    }

                    if( empty( $array_cat ) ){
                        foreach ( $terms as $term ){
                            $array_cat[$term->slug] = $term->term_id;
                        }
                    }

                    if( $array_cat ){

                        if( $yoast_primary_cat && isset( $primary_cat->slug ) && $primary_cat->slug  ){
                            $p_cat = $primary_cat->slug;
                        }else{

                            asort($array_cat);
                            foreach( $array_cat as $key => $cat ){
                                $p_cat = $key;
                                break;
                            }
                        }
                    }

                    if( isset( $p_cat ) ){
                        $url = str_replace( $product_base,'/'.$p_cat, $permalink );
                    }
                    
                }elseif( $terms && $url_type == 'full-path' ){

                    $product_base = str_replace( '%product_cat%','', $product_base );
                    $url = str_replace( $product_base, '/', $permalink );
                    
                }
               

            }else{

                if( $url_type == 'full-path' ){

                    $url = str_replace( $product_base,'/%product_cat%', $permalink );
                    
                }elseif( $url_type == 'primary-category' ){

                    $array_cat = array();
                    if( $terms ){

                        foreach ( $terms as $term ){
                            if ( $term->parent == 0 ) {
                                $array_cat[$term->slug] = $term->term_id;
                            }
                        }

                        if( empty( $array_cat ) ){
                            foreach ( $terms as $term ){
                                $array_cat[$term->slug] = $term->term_id;
                            }
                        }
                    }

                    if( $array_cat ){

                        if( $yoast_primary_cat && isset( $primary_cat->slug ) && $primary_cat->slug  ){
                            $p_cat = $primary_cat->slug;
                        }else{

                            asort($array_cat);
                            foreach( $array_cat as $key => $cat ){
                                $p_cat = $key;
                                break;
                            }

                        }
                    }

                    $product_base = '/' . trim( $product_base, '/' ) . '/';
                    if( isset( $p_cat ) ){
                        $url = str_replace( $product_base,'/'.$p_cat.'/', $permalink );
                    }
                    
                }elseif( $url_type == 'product-slug'){

                    $product_base = '/' . trim( $product_base, '/' ) . '/';
                    $url = str_replace( $product_base, '/', $permalink );

                }else{
                    $url = $permalink;
                }

            }

            if( !isset( $url ) ){

                $url = $permalink;

            }

            return $url;

        }

        public function replace_product_link_request( $request ){

            $structure = get_option( 'permalink_structure' );
            if( empty( $structure ) ){
                return $request;
            }

            global  $wp, $wpdb ;
            $url = $wp->request;

            if ( !empty($url) ) {
            
            
                $url = trim($url,'/');
                $url_array = explode('/',$url);
                $post_name = end($url_array);

                $sql = "SELECT COUNT(ID) as count_id FROM {$wpdb->posts} WHERE post_name = %s AND post_type = %s";
                $query = $wpdb->prepare( $sql, [ $post_name, 'product' ] );
                $num = intval( $wpdb->get_var( $query ) );
                
                if ( $num > 0 ) {

                    
                    $replace['post_type'] = 'product';
                    $replace['product'] = $post_name;
                    $replace['name'] = $post_name;
                    $replace['page'] = '';
                    return $replace;

                }

            }

            return $request;

        }

    }

    $GLOBALS[ 'sfufw_global' ] = new Seo_Friendly_Urls_For_Woocommerce_Permalink_Replace();
    
}


