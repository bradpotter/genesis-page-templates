<?php
/**
 * Genesis Page Templates plugin for Genesis 2.0.0+.
 *
 * @package    GenesisPageTemplates
 * @author     Brad Potter
 * @copyright  Copyright (c) 2016, Brad Potter
 * @license    GPL-2.0+
 * @link       http://bradpotter.com/plugins/genesis-page-templates
 */

remove_action( 'genesis_loop', 'genesis_do_loop' );

add_action( 'genesis_loop', 'genesis_page_templates_custom_loop' );
/**
 * Genesis Page Templates Custom Loop.
 * 
 * @since 1.0.1
 */
function genesis_page_templates_custom_loop() {
	
	global $paged;
	global $query_args;
    
	$gcl_post_type = esc_attr( genesis_get_custom_field( '_gcl_post_type' ) );
	$gcl_taxonomy = esc_attr( genesis_get_custom_field( '_gcl_taxonomy' ) );
	$gcl_tax_term = esc_attr( genesis_get_custom_field( '_gcl_tax_term' ) );
	$gcl_posts_per_page = esc_attr( genesis_get_custom_field( '_gcl_posts_per_page' ) );
	$gcl_order_by = esc_attr( genesis_get_custom_field( '_gcl_order_by' ) );
	$gcl_order = esc_attr( genesis_get_custom_field( '_gcl_order' ) );
	
	$args = array(
		'post_type'        => $gcl_post_type,
		'posts_per_page'   => $gcl_posts_per_page,
		'orderby'          => $gcl_order_by,
		'order'            => $gcl_order,
		'paged'            => $paged,
	);
	
	if ( ! empty( $gcl_taxonomy ) && empty( $gcl_tax_term ) ) {
		
		$all_tax_terms = array();
		$tax_terms = get_terms( $gcl_taxonomy );
		
		foreach ( $tax_terms as $tax_term ) {
			
			$all_tax_terms[] = $tax_term->slug;
		}
		
		$args['tax_query'] = array(
			array(
				'taxonomy' => $gcl_taxonomy,
				'field'    => 'slug',
				'terms'    => $all_tax_terms,
			),
		);
	
	} elseif ( ! empty( $gcl_taxonomy ) && ! empty( $gcl_tax_term ) ) {
	
		$args['tax_query'] = array(
			array(
				'taxonomy' => $gcl_taxonomy,
				'field'    => 'slug',
				'terms'    => $gcl_tax_term,
			),
		);
	}
	
	genesis_custom_loop( wp_parse_args( $query_args, $args ) );
}

add_action( 'genesis_before_loop', 'genesis_page_templates_post_info' );
/**
 * Genesis Page Templates custom loop post info control.
 * 
 * @since 1.0.1
 */
function genesis_page_templates_post_info() {
    
    $gcl_post_info = esc_attr( genesis_get_custom_field( '_gcl_post_info' ) );
    
    if ( 'no' == $gcl_post_info ) {
    	remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
    }
}

add_action( 'genesis_before_loop', 'genesis_page_templates_post_meta' );
/**
 * Genesis Page Templates custom loop post meta control.
 * 
 * @since 1.0.1
 */
function genesis_page_templates_post_meta() {
    
    $gcl_post_meta = esc_attr( genesis_get_custom_field( '_gcl_post_meta' ) );
    
    if ( 'no' == $gcl_post_meta ) {
    	remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
    }
}

genesis();
