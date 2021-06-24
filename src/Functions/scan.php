<?php

namespace nathanwooten\Filesystem\Functions;

use nathanwooten\Filter\{

	FilterDots

};

use function nathanwooten\Filesystem\Functions\{

	apply_filters,
	get_filter,
	normalize,


};

function scan( $directory, array $filters, array $fullScan = null )
{

	$fullScan = array_values( (array) $fullScan );

	$directory = normalize( $directory );
	$scan = scandir( $directory );
	$filtered = apply_filters( $scan, $filters, [ 'directory' => $directory ] );

	foreach ( $filtered as $item ) {

		$path = $directory . normalize( $item );
		$fullScan[] = $path;

		$fullScan = scan( $path, $filters, $fullScan );
	}

	return $fullScan;

}
