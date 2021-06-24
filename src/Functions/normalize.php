<?php

namespace nathanwooten\Filesystem\Functions;

use nathanwooten\Filesystem\{

	Filesystem,
	FilesystemInput

};

use function nathanwooten\Filesystem\Functions\{

	get_replace,
	get_separator,
	has_extension

};

use Exception;

function normalize( $input )
{

	$normalized = [];

	if ( $input instanceof FilesystemInput ) {
		$input = $input->getInput();
	}

	if ( ! in_array( gettype( $input ), [ 'string', 'array' ] ) ) {
		throw new Exception( 'Only normalizing strings and arrays' );
	}

	$input = (array) $input;
	$input = array_values( $input );

		$replace = get_replace();
		$separator = get_separator();

	foreach ( $input as $key => $item ) {

		$item = str_replace( $replace, $separator, $item );
		$item = 0 < $key ? ltrim( $item, $separator ) : $item;

		if ( ! has_extension( $item ) ) {
			$item = rtrim( $item, $separator ) . $separator;
		}

		$normalized[ $key ] = $item;
	}

	$normalized = implode( '', $normalized );

	return $normalized;

}
