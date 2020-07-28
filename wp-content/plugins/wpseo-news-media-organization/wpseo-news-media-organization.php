<?php
/**
 * Plugin Name:     Yoast schema @type: NewsMediaOrganization
 * Plugin URI:      https://github.com/INN/umbrella-publicsource
 * Description:     Changes the schema.org @type for the site's Organization to NewsMediaOrganization
 * Author:          INN Labs
 * Author URI:      https://labs.inn.org
 * Text Domain:     wpseo-news-media-organization
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Wpseo_News_Media_Organization
 */

/**
 * Filter the organization @type to be NewsMediaOrganization
 *
 * A thin implementation of https://schema.org/NewsMediaOrganization within the Yoast SEO plugin's Schema API, using the [`wpseo_schema_<$class>`](https://developer.yoast.com/features/schema/api/#change-a-graph-pieces-data) filter on the `Organization` class.
 * 
 * @link https://github.com/INN/umbrella-publicsource/issues/50
 * @link https://schema.org/NewsMediaOrganization
 */
add_filter( 'wpseo_schema_organization', function( $data ) {
	$data['@type'] = 'NewsMediaOrganization';
	return $data;
} );
