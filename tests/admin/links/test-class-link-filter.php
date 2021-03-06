<?php

class WPSEO_Link_Filter_Test extends WPSEO_UnitTestCase {

	/**
	 * @dataProvider link_provider
	 *
	 * @param string     $currentPage
	 * @param WPSEO_Link $link
	 * @param bool       $expected
	 */
	public function test_internal_link_with_fragment_filter( $currentPage, WPSEO_Link $link, $expected ) {
		$filter = new WPSEO_Link_Filter( $currentPage );

		$this->assertEquals( $expected, $filter->internal_link_with_fragment_filter( $link ) );
	}

	/**
	 * Provides a couple of internal links
	 *
	 * @return array
	 */
	public function link_provider() {

		return array(
			array(
				'page',
				new WPSEO_Link( 'testpage', 0, 'internal' ),
				true,
			),
			array(
				'testpage',
				new WPSEO_Link( 'testpage', 0, 'internal' ),
				false,
			),
			array(
				'page',
				new WPSEO_Link( 'page#fragment', 0, 'internal' ),
				false,
			),
			array(
				'page',
				new WPSEO_Link( 'testpage#fragment', 0, 'internal' ),
				true,
			),
			array(
				'page',
				new WPSEO_Link( 'page?param=foo', 0, 'internal' ),
				false,
			),
			array(
				'page',
				new WPSEO_Link( 'testpage?param=foo', 0, 'internal' ),
				true,
			),
			array(
				'page',
				new WPSEO_Link( 'http://extern.al/page?param=foo', 0, 'external' ),
				true,
			),
			array(
				'page',
				new WPSEO_Link( '/', 0, 'internal' ),
				true,
			),
			array(
				'/',
				new WPSEO_Link( '/', 0, 'internal' ),
				true,
			),
			array(
				'page',
				new WPSEO_Link( '?param=foo', 0, 'internal' ),
				false,
			),
			array(
				'page',
				new WPSEO_Link( '#fragment', 0, 'internal' ),
				false,
			),
		);
	}
}