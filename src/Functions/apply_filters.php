<?php

namespace nathanwooten\Filesystem\Functions;

use function nathanwooten\Filesystem\Functions\apply_filter_item;

function apply_filters( array $scan, $filters = [], array $extra = [] )
{

	$applied = [];

	foreach ( $scan as $key => $item ) {
		$filtered = apply_filters_item( $item, $filters, $extra );

		if ( ! is_null( $filtered ) ) {
			$applied[ $key ] = $filtered;
		}
	}

	return $applied;

}
