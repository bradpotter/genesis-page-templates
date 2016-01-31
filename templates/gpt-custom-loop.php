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

add_action( 'genesis_loop', 'genesis_page_templates_custom_loop' );
/**
 * Genesis Page Templates Custom Loop.
 * 
 * @since 1.0.1
 */
function genesis_page_templates_custom_loop() {

	$gcl_post_type = esc_attr( genesis_get_custom_field( '_gcl_post_type' ) );
	$gcl_taxonomy = esc_attr( genesis_get_custom_field( '_gcl_taxonomy' ) );
	$gcl_tax_term = esc_attr( genesis_get_custom_field( '_gcl_tax_term' ) );
	$gcl_posts_per_page = esc_attr( genesis_get_custom_field( '_gcl_posts_per_page' ) );
	$gcl_order_by = esc_attr( genesis_get_custom_field( '_gcl_order_by' ) );
	$gcl_order = esc_attr( genesis_get_custom_field( '_gcl_order' ) );
	$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
	
	$query_args = wp_parse_args(
		array(
			'post_type'        => $gcl_post_type,
			'posts_per_page'   => $gcl_posts_per_page,
			'orderby'          => $gcl_order_by,
			'order'            => $gcl_order,
			'paged'            => $paged,
			)
		);
	
	if ( ! empty( $gcl_tax_term ) ) {
		$terms = empty( $gcl_tax_term ) ? get_terms( $gcl_taxonomy ) : $gcl_tax_term;
		$args['tax_query'] = array(
			array(
				'taxonomy' => $gcl_taxonomy,
				'field'    => 'slug',
				'terms'    => $terms,
				)
			);
	}
	
	genesis_custom_loop( $query_args );
}
