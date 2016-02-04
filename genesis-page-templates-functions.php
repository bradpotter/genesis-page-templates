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

add_filter( 'theme_page_templates', 'genesis_page_templates_add_page_template' );
/**
 * Add page templates.
 * 
 * @since 1.0.0
 */
function genesis_page_templates_add_page_template( $page_templates ) {
		
	$page_templates['custom_loop'] = __( 'Custom Loop', 'genesis-page-templates' );
		
	return $page_templates;
}

add_action( 'template_redirect', 'genesis_page_templates_include_page_template' );
/**
 * Modify page based on selected page template.
 * 
 * @since 1.0.0
 */
function genesis_page_templates_include_page_template() {
	
	$page_template = get_post_meta( get_the_ID(), '_wp_page_template', true );
		
	if ( 'custom_loop' == $page_template ) {
	
		require_once plugin_dir_path( __FILE__ ) . '/templates/gpt-custom-loop.php';
	}
}
