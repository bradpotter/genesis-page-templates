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

add_action( 'add_meta_boxes', 'genesis_page_templates_add_inpost_meta_box', 10, 2 );
/**
 * Register a new meta box to the page edit screen.
 *
 * Allow the user to set Custom Loop Settings on a per-page basis.
 *
 * If the post type does not support genesis-page-templates, then the Custom Loop Options meta box will not be added.
 *
 * @since 1.0.0
 *
 * @see genesis_page_templates_inpost_meta_box() Generates the content in the meta box.
 */
function genesis_page_templates_add_inpost_meta_box( $post_type, $post ) {

	if ( 'page' !== $post_type ) {
		return false;
	}
	
	if ( 'custom_loop' === get_post_meta( $post->ID, '_wp_page_template', true ) ) {
		add_meta_box(
			'genesis_page_templates_inpost_meta_box',
			__( 'Custom Loop Settings', 'genesis-page-templates' ),
			'genesis_page_templates_inpost_meta_box',
			'page',
			'normal',
			'high'
		);
	}
}

/**
 * Callback for in-post Custom Loop Settings meta box.
 *
 * @since 1.0.0
 */
function genesis_page_templates_inpost_meta_box() {

	wp_nonce_field( 'genesis_page_templates_inpost_meta_save', 'genesis_page_templates_inpost_meta_nonce' );

	?>

	<p><label for="gcl_post_type"><b><?php _e( 'Post Type', 'genesis-page-templates' ); ?></b> <?php _e( '(Enter post, page or custom post type)', 'genesis-page-templates' ); ?></label></p>
	<p><input class="large-text" type="text" name="genesis_custom_loop[_gcl_post_type]" id="gcl_post_type" placeholder="" value="<?php echo esc_attr( genesis_get_custom_field( '_gcl_post_type' ) ); ?>" /></p>

	<p><label for="gcl_taxonomy"><b><?php _e( 'Taxonomy', 'genesis-page-templates' ); ?></b> <?php _e( '(Enter taxonomy, example: category, post_tag, etc.)', 'genesis-page-templates' ); ?></label></p>
	<p><input class="large-text" type="text" name="genesis_custom_loop[_gcl_taxonomy]" id="gcl_taxonomy" placeholder="" value="<?php echo esc_attr( genesis_get_custom_field( '_gcl_taxonomy' ) ); ?>" /></p>

	<p><label for="gcl_tax_term"><b><?php _e( 'Taxonomy Term', 'genesis-page-templates' ); ?></b> <?php _e( '(Enter taxonomy term, example: featured, blog, etc. )', 'genesis-page-templates' ); ?></label></p>
	<p><input class="large-text" type="text" name="genesis_custom_loop[_gcl_tax_term]" id="gcl_tax_term" placeholder="" value="<?php echo esc_attr( genesis_get_custom_field( '_gcl_tax_term' ) ); ?>" /></p>

	<p><label for="gcl_posts_per_page"><b><?php _e( 'Post Per Page', 'genesis-page-templates' ); ?></b> <?php _e( '(Enter number of posts to display)', 'genesis-page-templates' ); ?></label></p>
	<p><input class="large-text" type="text" name="genesis_custom_loop[_gcl_posts_per_page]" id="gcl_posts_per_page" placeholder="" value="<?php echo esc_attr( genesis_get_custom_field( '_gcl_posts_per_page' ) ); ?>" /></p>

	<p><label for="gcl_order_by"><b><?php _e( 'Order By', 'genesis-page-templates' ); ?></b> <?php _e( '(Enter author, title, name, type, date, rand, etc.)', 'genesis-page-templates' ); ?></label></p>
	<p><input class="large-text" type="text" name="genesis_custom_loop[_gcl_order_by]" id="gcl_order_by" placeholder="" value="<?php echo esc_attr( genesis_get_custom_field( '_gcl_order_by' ) ); ?>" /></p>

	<p><label for="gcl_order"><b><?php _e( 'Order', 'genesis-page-templates' ); ?></b> <?php _e( '(Enter ASC or DESC)', 'genesis-page-templates' ); ?></label></p>
	<p><input class="large-text" type="text" name="genesis_custom_loop[_gcl_order]" id="gcl_order" placeholder="" value="<?php echo esc_attr( genesis_get_custom_field( '_gcl_order' ) ); ?>" /></p>
	
	<p><label for="gcl_post_info"><b><?php _e( 'Display Post Info', 'genesis-page-templates' ); ?></b> <?php _e( '', 'genesis-page-templates' ); ?></label></p>
	<select name="genesis_custom_loop[_gcl_post_info]" id="gcl_post_info" />
	<option value="yes"<?php selected( genesis_get_custom_field( '_gcl_post_info' ), 'yes' ); ?>><?php _e( 'Yes', 'genesis-page-templates' ); ?></option>
	<option value="no"<?php selected( genesis_get_custom_field( '_gcl_post_info' ), 'no' ); ?>><?php _e( 'No', 'genesis-page-templates' ); ?></option>
	</select>
	
	<p><label for="gcl_post_meta"><b><?php _e( 'Display Post Meta', 'genesis-page-templates' ); ?></b> <?php _e( '', 'genesis-page-templates' ); ?></label></p>
	<select name="genesis_custom_loop[_gcl_post_meta]" id="gcl_post_meta" />
	<option value="yes"<?php selected( genesis_get_custom_field( '_gcl_post_meta' ), 'yes' ); ?>><?php _e( 'Yes', 'genesis-page-templates' ); ?></option>
	<option value="no"<?php selected( genesis_get_custom_field( '_gcl_post_meta' ), 'no' ); ?>><?php _e( 'No', 'genesis-page-templates' ); ?></option>
	</select>
	
	<p><?php _e( 'See the <a href="https://codex.wordpress.org/Class_Reference/WP_Query#Parameters"/>WordPress Codex</a> for a complete list of parameters to use.', 'genesis-page-templates' ); ?></p>

	<?php
}

add_action( 'save_post', 'genesis_page_templates_inpost_meta_save', 1, 2 );
/**
 * Save the settings when we save a post or page.
 *
 * @since 1.0.0
 *
 * @param integer  $post_id Post ID.
 * @param stdClass $post    Post object.
 *
 * @return null
 */
function genesis_page_templates_inpost_meta_save( $post_id, $post ) {

	if ( ! isset( $_POST['genesis_custom_loop'] ) || ! check_admin_referer( 'genesis_page_templates_inpost_meta_save', 'genesis_page_templates_inpost_meta_nonce' ) ) {
		return false;
	}

	$data = wp_unslash( $_POST['genesis_custom_loop'] );
	
	$defaults = array(
		'_gcl_post_type'        => '',
		'_gcl_taxonomy'         => '',
		'_gcl_tax_term'         => '',
		'_gcl_posts_per_page'   => '',
		'_gcl_order_by'         => '',
		'_gcl_order'            => '',
		'_gcl_post_info'        => '',
		'_gcl_post_meta'        => '',
	);

	// Merge user submitted options with fallback defaults.
	$data = wp_parse_args( $data, $defaults );
	
	$clean_data = array();

	foreach ( (array) $data as $key => $value ) {
		if ( in_array( $key, array_keys( $defaults ), true ) ) {
			$clean_data[ $key ] = sanitize_text_field( $value );
		}
	}

	genesis_save_custom_fields( $clean_data, 'genesis_page_templates_inpost_meta_save', 'genesis_page_templates_inpost_meta_nonce', $post );
}
