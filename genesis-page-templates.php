<?php
/**
 * Genesis Page Templates plugin for Genesis 2.0.0+.
 *
 * @package    GenesisPageTemplates
 * @author     Brad Potter
 * @copyright  Copyright (c) 2016, Brad Potter
 * @license    GPL-2.0+
 * @link       http://bradpotter.com/plugins/genesis-page-templates
 *
 * @wordpress-plugin
 * Plugin Name: Genesis Page Templates
 * Plugin URI:  http://www.bradpotter.com/plugins/genesis-page-templates
 * Description: Adds page templates to the Genesis Framework.
 * Version:     1.0.1
 * Author:      Brad Potter
 * Author URI:  http://www.bradpotter.com/
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: genesis-page-templates
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

register_activation_hook( __FILE__, 'genesis_page_templates_activation' );
/**
 * Ensure Genesis is active, and that the version is not less than 2.0.0.
 *
 * If not, the plugin deactivates itself.
 *
 * @since 1.0.0
 */
function genesis_page_templates_activation() {
	
	if ( ! defined( 'PARENT_THEME_VERSION' ) || version_compare( PARENT_THEME_VERSION, '2.0.0', '<' ) ) {
		deactivate_plugins( plugin_basename( __FILE__ ) );
		wp_die(
			sprintf(
				__( 'Sorry, you cannot run Genesis Page Templates without <a href="%s">Genesis 2.0.0</a>, or greater.', 'genesis-page-templates' ),
				'http://bradpotter.com/go/genesis'
			)
		);
	}
}

add_action( 'genesis_init', 'genesis_page_templates_init', 15 );
/**
 * Load Genesis Page Templates functions
 *
 * @since 1.0.0
 */
function genesis_page_templates_init() {
		
	require_once plugin_dir_path( __FILE__ ) . '/genesis-page-templates-functions.php';
	
	if ( is_admin() ) {
	
		require_once plugin_dir_path( __FILE__ ) . '/genesis-page-templates-admin.php';
	}
}
