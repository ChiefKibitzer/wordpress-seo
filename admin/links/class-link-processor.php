<?php
/**
 * @package WPSEO\Admin\Links
 */

/**
 * Represents the conversion from array with string links into WPSEO_Link objects.
 */
class WPSEO_Link_Processor {

	/** @var WPSEO_Link_Type_Classifier */
	protected $classifier;

	/** @var WPSEO_Link_Internal_Lookup */
	protected $internal_lookup;

	/**
	 * Sets the dependencies for this object.
	 *
	 * @param WPSEO_Link_Type_Classifier $classifier      The classifier to use.
	 * @param WPSEO_Link_Internal_Lookup $internal_lookup The internal lookup to use.
	 */
	public function __construct( WPSEO_Link_Type_Classifier $classifier, WPSEO_Link_Internal_Lookup $internal_lookup ) {
		$this->classifier = $classifier;
		$this->internal_lookup = $internal_lookup;
	}

	/**
	 * Formats an array of links to WPSEO_Link object.
	 *
	 * @param array $extracted_links The links for format.
	 *
	 * @return WPSEO_Link[] The formatted links.
	 */
	public function process( array $extracted_links ) {
		return array_map( array( $this, 'process_link' ), $extracted_links );
	}

	public function process_link( $link ) {
		$link_type = $this->classifier->classify( $link );
		$target_post_id = $this->internal_lookup->lookup( $link, $link_type );

		return new WPSEO_Link( $link, $target_post_id, $link_type );

	}
}