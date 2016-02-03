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

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

add_action( 'admin_notices', 'genesis_page_templates_notice_requires' );
/**
 * Add a notice if Genesis isn't active, or the version is less than 2.0.0.
 *
 * @since 1.0.0
 */
function genesis_page_templates_notice_requires() {
	if ( defined( 'PARENT_THEME_VERSION' ) && version_compare( PARENT_THEME_VERSION, '2.0.0', '>' ) ) {
		return false;
	}
	?>
	<div class="error">
		<p>
			<?php
			printf(
				__( 'Genesis Page Templates requires <a href="%s">Genesis 2.0.0</a>, or greater to function.', 'genesis-page-templates' ),
				'http://bradpotter.com/go/genesis'
			);
			?>
		</p>
	</div>
	<?php
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
