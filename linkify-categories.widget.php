<?php
/**
 * Linkify Categories plugin widget code
 *
 * Copyright (c) 2011-2024 by Scott Reilly (aka coffee2code)
 *
 * @package Linkify_Categories_Widget
 * @author  Scott Reilly
 * @version 005
 */

defined( 'ABSPATH' ) or die();

require_once( dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'linkify-widget.php' );

if ( class_exists( 'WP_Widget' ) && ! class_exists( 'c2c_LinkifyCategoriesWidget' ) ) :

class c2c_LinkifyCategoriesWidget extends c2c_LinkifyWidget {

	/**
	 * Returns the version of the widget.
	 *
	 * @since 004
	 */
	public static function version() {
		return '005';
	}

	/**
	 * Constructor.
	 */
	public function __construct() {
		$config = array(
			// input can be 'checkbox', 'multiselect', 'select', 'short_text', 'text', 'textarea', 'hidden', or 'none'
			// datatype can be 'array' or 'hash'
			// can also specify input_attributes
			'title' => array(
				'input'   => 'text',
				'default' => __( 'Categories', 'linkify-categories' ),
				'label'   => __( 'Title', 'linkify-categories' ),
			),
			'categories' => array(
				'input'   => 'text',
				'default' => '',
				'label'   => __( 'Categories', 'linkify-categories' ),
				'help'    => __( 'A single category ID/slug, or multiple category IDs/slugs defined via a comma-separated and/or space-separated string.', 'linkify-categories' ),
			),
			'before' => array(
				'input'   => 'text',
				'default' => '',
				'label'   => __( 'Before text', 'linkify-categories' ),
				'help'    => __( 'Text to display before all categories.', 'linkify-categories' ),
			),
			'after' => array(
				'input'   => 'text',
				'default' => '',
				'label'   => __( 'After text', 'linkify-categories' ),
				'help'    => __( 'Text to display after all categories.', 'linkify-categories' ),
			),
			'between' =>  array(
				'input'   => 'text',
				'default' => ', ',
				'label'   => __( 'Between categories', 'linkify-categories' ),
				'help'    => __( 'Text to appear between categories.', 'linkify-categories' ),
			),
			'before_last' =>  array(
				'input'   => 'text',
				'default' => '',
				'label'   => __( 'Before last category', 'linkify-categories' ),
				'help'    => __( 'Text to appear between the second-to-last and last element, if not specified, \'between\' value is used.', 'linkify-categories' ),
			),
			'none' =>  array(
				'input'   => 'text',
				'default' => __( 'No categories specified to be displayed', 'linkify-categories' ),
				'label'   => __( 'None text', 'linkify-categories' ),
				'help'    => __( 'Text to appear when no categories have been found.  If blank, then the entire function doesn\'t display anything.', 'linkify-categories' ),
			),
		);

		parent::__construct(
			'linkify_categories',
			__( 'Linkify Categories', 'linkify-categories' ),
			__( 'Converts a list of categories (by slug or ID) into links to those categories.', 'linkify-categories' ),
			$config
		);
	}

	/**
	 * Outputs the main content within the body of the widget.
	 *
	 * @since 005
	 *
	 * @param array $args Widget args.
	 * @param array $instance Widget instance.
	 */
	public function widget_content( $args, $instance ) {
		extract( $args );
		c2c_linkify_categories( $categories, $before, $after, $between, $before_last, $none );
	}

} // end class c2c_LinkifyCategoriesWidget

add_action( 'widgets_init', array( 'c2c_LinkifyCategoriesWidget', 'register_widget' ) );

endif; // end if !class_exists()
