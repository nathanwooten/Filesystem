<?php

namespace nathanwooten\Filesystem\Functions;

use function nathanwooten\Filesystem\Functions\get_filter;

function apply_filters_item( $item, $filters, $extra = null )
{

	foreach ( $filters as $filter ) {
		$filter = get_filter( $filter );

		$item = $filter( $item, null, null, $extra );
	}

	return $item;

}
