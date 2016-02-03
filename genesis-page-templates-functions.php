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
 * @since  1.0.0
 * @param  array $page_templates The existing page templates.
 * @return array $page_templates The modified page templates.
 */
function genesis_page_templates_add_page_template( $page_templates ) {
	$page_templates['custom_loop'] = __( 'Custom Loop', 'genesis-page-templates' );

	return $page_templates;
}

add_action( 'template_include', 'genesis_page_templates_include_page_template' );
/**
 * Modify page based on selected page template.
 *
 * @since  1.0.0
 * @param  string $template The path to the template being included.
 * @return string $template The modified template path to be included.
 */
function genesis_page_templates_include_page_template( $template ) {
	if ( 'custom_loop' === get_post_meta( get_the_ID(), '_wp_page_template', true ) ) {
		$template = plugin_dir_path( __FILE__ ) . '/templates/gpt-custom-loop.php';
	}

	return $template;
}
