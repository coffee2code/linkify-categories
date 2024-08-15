<?php

defined( 'ABSPATH' ) or die();

class Linkify_Categories_Test extends WP_UnitTestCase {

	private $cat_ids = array();

	public function setUp() {
		parent::setUp();
		$this->cat_ids = $this->factory->category->create_many( 5 );
	}


	//
	//
	// HELPER FUNCTIONS
	//
	//


	protected function get_slug( $cat_id ) {
		return get_category( $cat_id )->slug;
	}

	/**
	 * Returns the expected output.
	 *
	 * @param int    $count     The number of categories to list.
	 * @param int    $cat_index Optional. The index into the $cat_ids array to start at. Default 0.
	 * @param string $between   Optional. The string to appear between categories. Default ', '.
	 * @param int    $cat_num   Optional. The category number. Default 1.
	 * @return string
	 */
	protected function expected_output( $count, $cat_index = 0, $between = ', ', $cat_num = 1 ) {
		$str = '';
		for ( $n = 1; $n <= $count; $n++, $cat_index++ ) {
			if ( ! empty( $str ) ) {
				$str .= $between;
			}
			$cat = get_category( $this->cat_ids[ $cat_index ] );
			$str .= '<a href="http://example.org/?cat=' . $cat->term_id . '" title="View all posts in ' . $cat->name . '">' . $cat->name . '</a>';
		}
		return $str;
	}

	protected function get_results( $args, $direct_call = true, $use_deprecated = false ) {
		ob_start();

		$function = $use_deprecated ? 'linkify_categories' : 'c2c_linkify_categories';

		if ( $direct_call ) {
			call_user_func_array( $function, $args );
		} else {
			do_action_ref_array( $function, $args );
		}

		$out = ob_get_contents();
		ob_end_clean();
		return $out;
	}


	//
	//
	// TESTS
	//
	//


	public function test_widget_class_name() {
		$this->assertTrue( class_exists( 'c2c_LinkifyCategoriesWidget' ) );
	}

	public function test_widget_version() {
		$this->assertEquals( '004', c2c_LinkifyCategoriesWidget::version() );
	}

	public function test_widget_hooks_widgets_init() {
		$this->assertEquals( 10, has_filter( 'widgets_init', array( 'c2c_LinkifyCategoriesWidget', 'register_widget' ) ) );
	}

	public function test_widget_made_available() {
		$this->assertContains( 'c2c_LinkifyCategoriesWidget', array_keys( $GLOBALS['wp_widget_factory']->widgets ) );
	}

	public function test_single_id() {
		$this->assertEquals( $this->expected_output( 1 ), $this->get_results( array( $this->cat_ids[0] ) ) );
		$this->assertEquals( $this->expected_output( 1 ), $this->get_results( array( $this->cat_ids[0], false ) ) );
	}

	public function test_array_of_ids() {
		$this->assertEquals( $this->expected_output( 5 ), $this->get_results( array( $this->cat_ids ) ) );
		$this->assertEquals( $this->expected_output( 5 ), $this->get_results( array( $this->cat_ids ), false ) );
	}

	public function test_single_slug() {
		$cat = get_category( $this->cat_ids[0] );
		$this->assertEquals( $this->expected_output( 1 ), $this->get_results( array( $cat->slug ) ) );
	}

	public function test_array_of_slugs() {
		$cat_slugs = array_map( array( $this, 'get_slug' ), $this->cat_ids );
		$this->assertEquals( $this->expected_output( 5 ), $this->get_results( array( $cat_slugs ) ) );
		$this->assertEquals( $this->expected_output( 5 ), $this->get_results( array( $cat_slugs ), false ) );
	}

	public function test_all_empty_categories() {
		$this->assertEmpty( $this->get_results( array( '' ) ) );
		$this->assertEmpty( $this->get_results( array( array() ) ) );
		$this->assertEmpty( $this->get_results( array( array( array(), '' ) ) ) );
	}

	public function test_an_empty_category() {
		$cat_ids = array_merge( array( '' ), $this->cat_ids );
		$this->assertEquals( $this->expected_output( 5 ), $this->get_results( array( $cat_ids ) ) );
		$this->assertEquals( $this->expected_output( 5 ), $this->get_results( array( $cat_ids ), false ) );
	}

	public function test_all_invalid_categories() {
		$this->assertEmpty( $this->get_results( array( 99999999 ) ) );
		$this->assertEmpty( $this->get_results( array( 'not-a-category' ) ) );
		$this->assertEmpty( $this->get_results( array( 'not-a-category' ), false ) );
	}

	public function test_an_invalid_category() {
		$cat_ids = array_merge( array( 99999999 ), $this->cat_ids );
		$this->assertEquals( $this->expected_output( 5 ), $this->get_results( array( $cat_ids ) ) );
		$this->assertEquals( $this->expected_output( 5 ), $this->get_results( array( $cat_ids ), false ) );
	}

	public function test_arguments_before_and_after() {
		$expected = '<div>' . $this->expected_output( 5 ) . '</div>';
		$this->assertEquals( $expected, $this->get_results( array( $this->cat_ids, '<div>', '</div>' ) ) );
		$this->assertEquals( $expected, $this->get_results( array( $this->cat_ids, '<div>', '</div>' ), false ) );
	}

	public function test_argument_between() {
		$expected = '<ul><li>' . $this->expected_output( 5, 0, '</li><li>' ) . '</li></ul>';
		$this->assertEquals( $expected, $this->get_results( array( $this->cat_ids, '<ul><li>', '</li></ul>', '</li><li>' ) ) );
		$this->assertEquals( $expected, $this->get_results( array( $this->cat_ids, '<ul><li>', '</li></ul>', '</li><li>' ), false ) );
	}

	public function test_argument_before_last() {
		$before_last = ', and ';
		$expected = $this->expected_output( 4 ) . $before_last . $this->expected_output( 1, 4, ', ', 5 );
		$this->assertEquals( $expected, $this->get_results( array( $this->cat_ids, '', '', ', ', $before_last ) ) );
		$this->assertEquals( $expected, $this->get_results( array( $this->cat_ids, '', '', ', ', $before_last ), false ) );
	}

	public function test_argument_none() {
		$missing = 'No categories to list.';
		$expected = '<ul><li>' . $missing . '</li></ul>';
		$this->assertEquals( $expected, $this->get_results( array( array(), '<ul><li>', '</li></ul>', '</li><li>', '', $missing ) ) );
		$this->assertEquals( $expected, $this->get_results( array( array(), '<ul><li>', '</li></ul>', '</li><li>', '', $missing ), false ) );
	}

	/*
	 * __c2c_linkify_categories_get_category_link()
	 */

	 public function test___c2c_linkify_categories_get_category_link() {
		$title = get_cat_name( $this->cat_ids[0] );
		$expected = sprintf(
			'<a href="http://example.org/?cat=%d" title="View all posts in %s">%s</a>',
			esc_attr( $this->cat_ids[0] ),
			esc_attr( $title ),
			esc_html( $title )
		);

		$this->assertEquals(
			$expected,
			__c2c_linkify_categories_get_category_link( $this->cat_ids[0] )
		);
	}

	public function test___c2c_linkify_categories_get_category_link_with_invalid_id() {
		$this->assertEmpty( __c2c_linkify_categories_get_category_link( -1 ) );
	}

}
