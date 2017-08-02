<?php
/**
 * Plugin name: Alternative Tribe Template Location
 * Description: Placing template overrides in a theme or even a child theme is not always optimal. This plugin adds support for locating template overrides within a wp-content/tribe-events directory. Useful for The Events Calendar, Event Tickets and related plugins.
 * Author:      Barry Hughes
 * Author URI:  https://codingkills.me
 * License:     GPLv3
 */

class Alternative_Tribe_Template_Location_Facilitator {
	protected $alternative_path = '';

	public function __construct() {
		if ( $this->alternative_path() ) {
			add_filter( 'tribe_events_template', array( $this, 'filter_template_paths' ) );
			add_filter( 'tribe_tickets_template', array( $this, 'filter_template_paths' ) );
		}
	}

	protected function alternative_path() {
		$path = trailingslashit( WP_CONTENT_DIR ) . 'tribe-events';

		if ( is_dir( $path ) && is_readable( $path ) ) {
			$this->alternative_path = $path;
			return true;
		}

		return false;
	}

	public function filter_template_paths( $path ) {
		// We expect the templat path to contain a /src/views/ component
		$src_views = strpos( $path, '/src/views/' );

		if ( ! $src_views ) {
			return $path;
		}

		$sub_path = substr( $path, $src_views + 11 );
		$possible_override = $this->alternative_path . '/' . $sub_path;

		if ( file_exists( $possible_override ) ) {
			return $possible_override;
		}

		return $path;
	}
}

function alt_tribe_template_location_facilitator() {
	static $object;

	return empty( $object )
		? $object = new Alternative_Tribe_Template_Location_Facilitator
		: $object;
}

alt_tribe_template_location_facilitator();